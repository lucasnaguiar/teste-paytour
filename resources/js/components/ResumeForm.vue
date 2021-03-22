<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div>
                    <div v-if="errors.length">
                        <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>
                </div>
                <div v-if="success" class="alert alert-success" role="alert">
                    Seus dados foram enviados com sucesso! Boa sorte :)
                </div>
                <div class="card">
                    <div class="card-header">
                        Enviar CV
                    </div>
                    <div class="card-body">
                        <form v-show="!loading" action="#" @submit.prevent="checkForm">

                            <div class="form-group">
                                <label for="iName">Nome</label>
                                <input type="text" class="form-control" v-model="resume.name" id="iName" >

                                <span class="invalid-feedback" role="alert">
                                <strong>mensagem de validação</strong>
                            </span>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="iEmail">Email</label>
                                    <input type="text" class="form-control " v-model="resume.email" id="iEmail">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="iPhone">Telefone</label>
                                    <the-mask type="tel" class="form-control" :mask="['(##) ####-####', '(##) #####-####']" id="iPhone" v-model="resume.phone"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="iPosition">Cargo Desejado</label>
                                <input type="text" class="form-control" v-model="resume.position" id="iPosition" >
                            </div>
                            <div class="form-group">
                                <label for="iLevel">Escolaridade</label>
                                <select class="form-control" v-model="resume.educationLevelId" id="iLevel">
                                    <option  selected value=""> Selecione...</option>
                                    <option v-for="(level, id) in educationLevels" :key="id" :value="id">{{level.name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="iObs">Observações</label>
                                <textarea class="form-control" v-model="resume.obs" id="iObs" rows="3" ></textarea>
                            </div>

                            <div class="form-group">
                                <label for="cv_file">Anexar Curriculum Vitae</label>
                                <input type="file" class="form-control-file" id="cv_file" v-on:change="onChange">
                            </div>

                            <hr>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>

                    </div>
                    <div v-show="loading" class="spinner-border loading" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .loading {
        margin: 50px auto 50px auto;
    }
</style>
<script>

export default {

    data: function() {
        return {
            educationLevels: [],
            errors: [],
            success: false,
            resume: {
                name: '',
                email: '',
                position: '',
                educationLevelId: '',
                phone: '',
                obs:'',
            },
            resumeFile: null,
            loading: false,
        }
    },
    mounted() {
        this.loadLevels()
    },
    watch: {
        errors (valor, valor2){
            console.log(valor)
        }
    },

    methods: {
        loadLevels: function (){
            axios.get('/api/niveis-escolaridade',{
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then((response) => {
                    this.educationLevels = response.data.data
                })
                .catch(function (error){
                    console.log(error)
                });
        },
        onChange: function(event) {
            this.resumeFile = event.target.files[0];
        },

        validEmail: function (email) {
            let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        validPhone: function (phone) {
            let re = /^\([0-9]{2}\) [0-9]?[0-9]{4}-[0-9]{4}$/;
            return re.test(phone);
        },
        sendResume: function(formData) {
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'Accept' : 'application/json'
                }
            }

            console.log('carregando')
            this.loading = true;
            axios.post('/api/resume', formData, config)
                .then(resp => {
                    if (resp.status === 201) {
                        this.success = true
                        this.resume = ''
                        this.resumeFile = null
                        document.getElementById('cv_file').value = null
                        document.getElementById('iPhone').value = null
                        this.loading = false
                    }
                    // window.location.reload()
                })
                .catch(errors => {
                    if (errors.response.status === 422) {
                        this.errors = Object.values(errors.response.data.errors).flat()
                    }
                    console.log(errors)
                })
            this.loading = false
        },
        checkForm: function (e) {
            this.errors = []

            if(!this.resume.name) {
                this.errors.push('O nome é obrigatório.');
            }

            if (!this.resume.email) {
                this.errors.push('O e-mail é obrigatório.');
            } else if (!this.validEmail(this.resume.email)) {
                this.errors.push('Utilize um e-mail válido.');
            }

            if(!document.getElementById('iPhone').value) {
                this.errors.push('O telefone é obrigatório')
            } else if (!this.validPhone(document.getElementById('iPhone').value)) {
                this.errors.push('Utilize um telefone válido.');
            }

            if(!this.resumeFile) {
                this.errors.push('Anexo obrigatório');
            }

            if(this.errors.length === 0) {

                const formData = new FormData()
                formData.append('name', this.resume.name)
                formData.append('email', this.resume.email)
                formData.append('phone', document.getElementById('iPhone').value)
                formData.append('position', this.resume.position)
                formData.append('educationLevelId', this.resume.educationLevelId)
                formData.append('obs', this.resume.obs)
                formData.append('selectedFile', this.resumeFile)
                this.sendResume(formData);
            }

            e.preventDefault();
        },

    }

}
</script>

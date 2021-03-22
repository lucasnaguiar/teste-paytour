<p>Olá {{$resume->name}}</p>

<p>Recebemos seu curriculum vitae</p>

Dados cadastrados:
    <p> Nome: {{$resume->name}}</p>
    <p> E-mail: {{$resume->email}}</p>
    <p> Telefone: {{$resume->phone}}</p>
    <p> Escolaridade: {{$resume->educationLevel->name}}</p>
    <p> Observação: {{$resume->obs}}</p>
    <p> Arquivo enviado: {{env('APP_URL') . '/'. $resume->file}}</p>
    <p> Hora do Envio: {{$resume->date_time}}</p>
    <p> IP: {{$resume->host_ip_address}}</p>


<p>Boa sorte :)</p>

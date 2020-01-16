 

<div class="container">

    <table class="table table-striped table-bordered">
       
        <thead>
            <tr>
                <th style="width:5%;"> Id</th>
                <th style="width:10%;">Nome</th>
                <th style="width:10%;">Sobrenome</th>
                <th style="width:15%;">Salario</th>
                <th style="width:15%;">Area</th>
             </tr>
        </thead>
        <tbody id='conteudo'>




        </tbody>

        


    </table>

</div>

<script>
var conteudo = document.querySelector('#conteudo');
$(document).ready(function() {
    
    $.ajax({
        url:"./assets/conexao/funcionarios.json",
        type:"GET",
        dataType:"JSON",
        success: (res) => {
            console.log(res.funcionarios)
            conteudo.innerHTML = '';
            for(let i = 0; i < res.funcionarios.length; i++) {
                console.log(i);
                let { id, nome, sobrenome, salario, area } = res.funcionarios[i];

                // Normaliza o nome da área
                let areaNome = normArea(area, res);
                conteudo.innerHTML += `
                <tr>
                    <td style="width:5%;">${id}</td>
                    <td style="width:10%;">${nome}</td>
                    <td style="width:10%;">${sobrenome}</td>
                    <td style="width:15%;">${formNum(salario)}</td>
                    <td style="width:15%;">${areaNome}</td>
                </tr>`
            }
        }
    })
});

</script>
<script>
function normArea(sigla, base) {
    let nome = "";
    base.areas.forEach(area => {
        if(area.codigo == sigla)
            nome = area.nome;
    });
    return nome;
}
</script>
<script>
// Função auxiliar
// Formata um valor numérico interno para uma valor de moeda
function formNum(valor) {
    return `R$ ${valor.toFixed(2).replace(".", ",")}`;
}
</script>


$(document).ready(
    $('#botao-consulta').on('click', function(){
        var res = validarDadosInformados();
        
        if (!res['erros']) {
            $.ajax({
                url: '../backend/funcoes.php',
                type: 'POST',
                data: {nomeCidade:$('#consulta-cidade').val(), dataConsulta:$('#data-consulta').val(), action:'consultaCidade'},
                success: function(data) {
                    debugger;
                    console.log(data); 
                }
            }).done(function(response) {
                debugger;
                if (!response['erros']) {
                    mostrarResultado(response);
                } else {
                    mostrarErros(response['erros']);
                }
            }
            );
        } else {
            mostrarErros(res['erros']);
        }
    })
);


function validarDadosInformados() {
    var res = [];
    var erros = [];
    var nomeCidade = $('#consulta-cidade').val().trim();
    var dataConsulta = $('#data-consulta').val().trim();
    
    erros = erros.concat(validarCidadeInformada(nomeCidade), validarDataInformada(dataConsulta));
    if (erros.length) {
        res['erros'] = erros;
    }

    return res;
}

function validarCidadeInformada(nomeCidade) {
    erros = [];
    var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    if (!nomeCidade) {
        erros.push('Cidade não informada.');
    }

    if (!isNaN(nomeCidade)) {
        erros.push('O nome da cidade não pode ser um número.')
    }

    if (format.test(nomeCidade)) {
        erros.push('O nome da cidade deve ser alfa-numérico, contendo no máximo hífens.');
    }

    return erros;
}

function validarDataInformada(data) {
    erros = [];
    
    if (!data) {
        erros.push('Data não informada.');
        return erros;
    } 
    
    data = data.replaceAll('/','-').split('-');

    data.forEach(arrayValue => {
        if (isNaN(arrayValue)) {
            erros.push('Data com formato inválido.')
            return erros;
        }
    });

    let ano = parseInt(data[0].length == 4 ? data[0] : data[2]);
    let mes = parseInt(data[1]);
    let dia = parseInt(data[0].length == 2 ? data[0] : data[2]);

    let diasPorMes = [31, anoBissexto(ano) ? 29 : 28 ,31,30,31,30,31,31,30,31,30,31];

    if (dia < 1 || dia > diasPorMes[mes - 1]) {
        erros.push('Data inválida');
    }
    
    return erros;
}

function anoBissexto(ano)
{
  return ((ano % 4 == 0) && (ano % 100 != 0)) || (ano % 400 == 0);
}

function mostrarErros(erros) {
    $('#resultado-erros ul').empty();
    
    erros.forEach(msgErro => {
        $('#resultado-erros ul').append(
            $('<li>').text(msgErro)
        )
    });
    
    $('#resultado-sucesso').hide();
    $('#resultado-erros').show();
}

function mostrarResultado(data) {
    var nomeCidade = $('#consulta-cidade').val();
    var bandeira = data['bandeira'];
    var casosConfirmados = data['casosConfirmados'];
    var obitos = data['qtdeObitos'];
    var recuperados = data['qtdeRecuperados'];
    var taxaMortalidade = ((obitos/casosConfirmados)*100).toFixed(2);
    var taxaRecuperados = ((recuperados/casosConfirmados)*100).toFixed(2);

    $('.bandeira h3').html(bandeira);
    $('.nomeCidade h2').text(nomeCidade);
    $('.bandeira h3').text(bandeira);
    $('#casos-confirmados').text('Casos confirmados: ' + casosConfirmados);
    $('#obitos').text('Óbitos: ' + obitos);
    $('#recuperados').text('Recuperados: ' + recuperados);
    $('#taxa-mortalidade').text('Taxa de mortalidade: ' + taxaMortalidade + '%');
    $('#taxa-recuperados').text('Taxa de recuperados: ' + taxaRecuperados + '%');

    $('#resultado-erros').hide();
    $('#resultado-sucesso').show();
}
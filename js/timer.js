var timer = document.querySelector('#timer');
var temPermissao = false;

if (timer) {
  carregaTimer();
}

function carregaTimer () {
  var tempoInicial = timer.dataset.tempoInicial;
  var estaPausado = timer.dataset.pausado;

  var tempo = tempoInicial.split(':');
  var hora = Number(tempo[0]);
  var minuto = Number(tempo[1]);
  var segundo = Number(tempo[2]);

  mostraTempo(hora, minuto, segundo);
  

  if (!estaPausado) {
    var interval = setInterval(() => {
      preencheTempo();
    }, 1000);
  }
    
  function preencheTempo () {
    if (segundo === 0) {
      segundo = 59;

      if (hora - 1 < 0 && minuto - 1 < 0) {
        emiteLembrete();
        return;
      }

      if (minuto - 1 <= 0) {
  
        hora = (hora === 0) ? 0 : hora - 1;
        minuto = (minuto === 0) ? 0 : (hora > 0) ? 59 : 0;
      } else {
        minuto -= 1;
      }

    } else {
      segundo -= 1;
    }


    mostraTempo(hora, minuto, segundo);
  }

  function mostraTempo (hora, minuto, segundo) {
    var horaTexto = null;
    var minutoTexto = null;
    var segundoTexto = null;

    if (hora < 10) {
      horaTexto = '0' + hora;
    } else {
      horaTexto = hora;
    }

    if (minuto < 10) {
      minutoTexto = '0' + minuto;
    } else {
      minutoTexto = minuto;
    }

    if (segundo < 10) {
      segundoTexto = '0' + segundo;
    } else {
      segundoTexto = segundo;
    }

    timer.textContent = horaTexto + 'h' + minutoTexto + 'min' + segundoTexto + 'seg';
  }
  
  function emiteLembrete () {
    clearInterval(interval);
    document.querySelector('#btn-reinicia').textContent = 'Finalizar';
    document.querySelector('#btn-pausa').style.display = 'none';
    swal(
      "Processo Finalizado!",
      `Para seguir para o próximo processo clique em 'Próximo', 
      ou para começar outra produção clique em 'Cancelar'`,
      "success"
    );
  }
}


function pedePermissaoNotificacao () {
  Notification.requestPermission().then(() => {
    temPermissao = true;
  });
}
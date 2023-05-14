let image = document.querySelector('img.inputBanner')
let file = document.querySelector('#banner')
let span = document.querySelector('#nameImage')

$('.password img').click(function (event) {
    let tag = $(event.currentTarget)
    let input = $('#'+tag.attr('class'))
    if (input.attr('type') == 'text') {
        tag.attr('src', 'svg/olhoaberto.svg')
        input.attr('type', 'password')        
    } else {
        tag.attr('src', 'svg/olhofechado.svg')
        input.attr('type', 'text')
    }
})

file.addEventListener('change', function()
{    
    let reader = new FileReader()

    if(file.files.length <= 0)
    {
        file.value = null
        span.innerHTML = 'Selecione uma imagem'
            if(typeof originalProfile !== 'undefined'){
                image.src = originalProfile
            }else{
                image.src = 'svg/profile.svg'

            }
        return
    }

    reader.onload = function ()
    {        
        image.src = reader.result
        span.innerHTML = file.files[0].name
    }

    reader.readAsDataURL(file.files[0])
})

function enviarFormulario(event) {
    if ($('#pass1').val() != $('#confirmpass').val()) {
        event.preventDefault()
        alert('Senhas não são iguais!')
    }
}

function certeza(event) {
    if (!(confirm("Tem certeza que deseja apagar?"))) {
        event.preventDefault()
    }
}

function certezaObj(event, url) {
    if (!(confirm("Tem certeza que deseja apagar?"))) {
        event.preventDefault()
    } else {
        window.location.href = url
    }
}
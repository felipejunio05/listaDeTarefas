function editar(nId) {
    let oForm = document.createElement("form")
    let oInput = document.createElement("input")
    let oInputID = document.createElement("input")
    let oButton = document.createElement("button")

    let oTarefa = document.getElementById(`tarefa_${nId}`)
    let cTarefa = fixConteudo(oTarefa.innerHTML)

    if (location.pathname.endsWith("index.php"))
        oForm.action = "index.php?pag=index&acao=atualizar"
    else
        oForm.action = "tarefa_controller.php?acao=atualizar"

    oForm.method = "post"
    oForm.className = "mt-4 row"

    oInput.type = "text"
    oInput.name = "tarefa"
    oInput.className = "col-9 form-control"
    oInput.value = cTarefa

    oInputID.type = "hidden"
    oInputID.name = "id"
    oInputID.value = nId

    oButton.type = "submit"
    oButton.className = "col-3 btn btn-info"
    oButton.innerHTML = "Atualizar"

    oForm.appendChild(oInput)
    oForm.appendChild(oInputID)
    oForm.appendChild(oButton)

    oTarefa.innerHTML = ""
    oTarefa.insertBefore(oForm, oTarefa[0])
}

function remover(nId) {
    if (location.pathname.endsWith("index.php"))
        location.href = `index.php?pag=index&acao=remover&id=${nId}`
    else
        location.href = `todas_tarefas.php?acao=remover&id=${nId}`

}

function marcarOK(nId) {
    if (location.pathname.endsWith("index.php"))
        location.href = `index.php?pag=index&acao=marcarOK&id=${nId}`
    else
        location.href = `todas_tarefas.php?acao=marcarOK&id=${nId}`
}

function fixConteudo(cTexto) {
    cTexto = cTexto.trim()

    for (let i = cTexto.length; i > 0; i--) {
        if (cTexto.substr(i, 1) == '(') {

            return cTexto.substr(0, i).trim()
        }
    }
}
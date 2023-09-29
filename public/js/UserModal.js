export default class UserModal {

    constructor(data) {
        Object.entries(data).forEach(userData => {
            const [key, value] = userData       // todas as chaves e valores de um objeto

            if (!isNaN(key)) return             // elimina as chaves numéricas padrões

            // formatação da propriedade estado_atividade
            if (this.estado_atividade) {
                if (this.estado_atividade == 1) this.estado_atividade = 'Ativo'
                else if (this.estado_atividade == 0) this.estado_atividade = 'Inativo'
            }

            this[key] = value                   // bind de propriedades e valores da classe
        })
    }

    /**
     * Configura o valor dos inputs de acordo com o seu nome e as propriedades deste objeto
     * 
     * @param {HTMLElement} modal -> Tag Html do Modal
     * @param {string} editLink -> uri para página de edição
     * @returns -> Retorna o próprio objeto para encadeamento
     */
    setModal(modal, editLink) {
        modal.querySelectorAll('input').forEach(e => {
            e.value = this[e.name]
        })
        // define a query string para acesso à pagina de edição do residente
        modal.querySelector('a.edit').href = `${editLink}?id=${this.id}`
    }

    /**
     * @param {array} usersArray  -> Array de objetos retornados da API
     * @param {number} value      -> referência por id
     * @returns -> O objeto pelo id referenciado 
     */
    static resolve(usersArray, value) {
        for (let i = 0; i <= usersArray.length; i++) {
            if (usersArray[i].id == value) {
                return usersArray[i]
            }
        }
    }

    /**
     * @param {HTMLElement} modal -> Exibe e esconde o modal
     */
    static displayModal(modal) {
        modal.classList.toggle('hideModal')
    }

    /**
     * @param {HTMLFormElement} form -> Reseta os valores dos inputs
     */
    static resetModal(form) {
        form.querySelectorAll('input').forEach(e => e.value = '')
    }
}
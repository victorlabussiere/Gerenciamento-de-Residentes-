export default class FormValidator {
    /**
     * 
     * @param {HTMLFormElement} form 
     * @param {NodeList} cssInputSelector 
     * @param {NodeList} cssErrorMessagesSelector 
     * 
     * Este método é responsável por realizar a validação de campos de
     * um formulário.
     * 
     * É essêncial que o @param form inserido no método tenha sido renderizado
     * utilizando a classe Form, disponibilizada no arquivo @file \UI\Form.php
     */
    static validaForm(form, cssInputSelector, cssErrorMessagesSelector) {

        form.addEventListener('submit', function (e) {
            const formInputs = form.querySelectorAll(cssInputSelector)
            const errorMessage = form.querySelectorAll(cssErrorMessagesSelector)

            for (let i = 0; i <= this.length; i++) {

                if (!errorMessage[i].classList.toString().includes('hideModal')) {
                    errorMessage[i].classList.toggle('hideModal')
                }

                if (formInputs[i].value === '' || formInputs[i].value === 'default') {
                    e.preventDefault()                              // interrompe o envio do formulário

                    formInputs[i].focus()                           // foca no input não preenchido
                    errorMessage[i].classList.toggle('hideModal')   // exibe mensagem de erro de input 

                    return                                          // interrompe o looping
                }
            }
        })
    }
}
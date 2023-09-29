<?php

namespace Http;

class Form
{
    protected array $inputs = [];
    /**
     * @param string $name              -> Nome do input
     * @param string $label             -> Apresentação do input na interface
     * @param string $placeholder       -> Nome do placeholder apresentado no input
     * @param string $value             -> Valor default de um input
     * @param string $type              -> Tipo do input com valor default = 'text
     * @param string $errorMessage      -> Mensagem de erro na interface
     */
    public function addInput(string $name, string $label, string $placeholder = '', string $value = '', string $type = 'text',  string $errorMessage = 'Preencha o campo para prosseguir'): Form
    {
        $this->inputs[] = "
                <label for='{$name}' class='inputField flex flex-col w-full font-semibold text-gray-500'>
                    {$label}
                    <input type='{$type}' name='{$name}' id='{$name}' placeholder='{$placeholder}' value='{$value}' class='border rounded-md p-2'>
                    <span class='text-red-500 text-xs hideModal'>{$errorMessage}</span>
                </label>
            ";

        return $this;
    }

    /**
     * @param string $name              -> Nome do input
     * @param string $label             -> Apresentação do input na interface
     * @param array $opts               -> Options que serão exibidas na caixa de seleção
     * @param string $errorMessage      -> Mensagem de erro na interface
     * 
     * @Annotation É extremament importante que o array $opts possua o seguinte formato: 
     * [
     *  ['value' => @example, 'text' => '@example],
     *  ['value' => @example, 'text' => '@example],
     *  ['value' => @example, 'text' => '@example]
     * ]
     * 
     * @param number 'value'             -> Valor do option 
     * @param string 'text'              -> Texto de exibição do option 
     */
    public function addSelect(string $name, string $label, array $opts, string $errorMessage = 'Preencha o campo para prosseguir'): Form
    {
        $options = '';

        foreach ($opts as $op) {
            $options .= "<option value='{$op['value']}'>{$op['text']}</option>";
        }

        $this->inputs[] =  "<label for='{$name}' class='flex flex-col w-full font-semibold text-gray-500'>
                {$label}
                <select  class='p-2 w-full text-gray-600 bg-gray-100 rounded' name='{$name}'>
                  {$options}
                </select>
                <span class='text-red-500 text-xs hideModal'>{$errorMessage}</span>
            </label>";

        return $this;
    }

    public function setMethod(string $method): Form
    {
        $this->inputs[0] = "<input type='hidden' name='_method' value='{$method}'> ";
        return $this;
    }

    public function setIdInput(string $id): Form
    {
        $this->inputs[] = "<input type='hidden' name='id' value='{$id}'>";
        return $this;
    }

    private static function getInputs(array $inputs): string
    {
        $text = '';
        foreach ($inputs as $input) {
            $text .= $input . " ";
        }

        return $text;
    }

    public function renderForm(string $action, string $method = 'get', string $submit = ''): void
    {
        $inputs = $this->getInputs($this->inputs);

        $submit = $submit
            ? "<input type='submit' class='text-white bg-orange-400 rounded px-5 py-2 w-2/6 duration-150 cursor-pointer font-semibold hover:shadow-md' value='{$submit}'>"
            : "";

        echo <<<FORM
            <form action='{$action}' method='{$method}' class='flex flex-col gap-5 items-center w-4/6 p-3 bg-white border rounded' id='FORM'>             
                $inputs
                $submit
            </form>
            <script type='module'>
                import FormValidator from '/js/FormValidator.js'
                const form = document.querySelector("form#FORM")
                FormValidator.validaForm(form, 'label.inputField>input, label>select', 'label>span')
            </script>
        FORM;
    }
}

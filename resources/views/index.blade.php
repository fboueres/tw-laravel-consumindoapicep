<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Consumindo API's</title>
</head>

<body>
    <div id="app">
        <div class="container p-5">
            <div class="card">
                <div class="card-header">Consumindo API de CEP e Google Maps</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center">Formulário de Endereço</h2>
                            <hr>
                            <form action="" class="px-5">
                                <div class="form-group my-2">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input type="text" name="cep" id="cep"
                                        class="form-control cep required">
                                </div>
                                <div class="form-group my-2">
                                    <label for="endereco" class="form-label">Logradouro</label>
                                    <input type="text" name="endereco" id="endereco" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="numero" class="form-label">Número</label>
                                    <input type="text" name="numero" id="numero" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="complemento" class="form-label">Complemento</label>
                                    <input type="text" name="complemento" id="complemento" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="bairro" class="form-label">Bairro</label>
                                    <input type="text" name="bairro" id="bairro" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" name="cidade" id="cidade" class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="">Selecione o Estado</option>
                                        <option name="AC" id="estado-ac" value="AC">Acre</option>
                                        <option name="AL" id="estado-al" value="AL">Alagoas</option>
                                        <option name="AP" id="estado-ap" value="AP">Amapá</option>
                                        <option name="AM" id="estado-am" value="AM">Amazonas</option>
                                        <option name="BA" id="estado-ba" value="BA">Bahia</option>
                                        <option name="CE" id="estado-ce" value="CE">Ceará</option>
                                        <option name="DF" id="estado-df" value="DF">Distrito Federal</option>
                                        <option name="ES" id="estado-es" value="ES">Espírito Santo</option>
                                        <option name="GO" id="estado-go" value="GO">Goiás</option>
                                        <option name="MA" id="estado-ma" value="MA">Maranhão</option>
                                        <option name="MT" id="estado-mt" value="MT">Mato Grosso</option>
                                        <option name="MS" id="estado-ms" value="MS">Mato Grosso do Sul
                                        </option>
                                        <option name="MG" id="estado-mg" value="MG">Minas Gerais</option>
                                        <option name="PA" id="estado-pa" value="PA">Pará</option>
                                        <option name="PB" id="estado-pb" value="PB">Paraíba</option>
                                        <option name="PR" id="estado-pr" value="PR">Paraná</option>
                                        <option name="PE" id="estado-pe" value="PE">Pernambuco</option>
                                        <option name="PI" id="estado-pi" value="PI">Piauí</option>
                                        <option name="RJ" id="estado-rj" value="RJ">Rio de Janeiro</option>
                                        <option name="RN" id="estado-rn" value="RN">Rio Grande do Norte
                                        </option>
                                        <option name="RS" id="estado-rs" value="RS">Rio Grande do Sul
                                        </option>
                                        <option name="RO" id="estado-ro" value="RO">Rondônia</option>
                                        <option name="RR" id="estado-rr" value="RR">Roraima</option>
                                        <option name="SC" id="estado-sc" value="SC">Santa Catarina</option>
                                        <option name="SP" id="estado-sp" value="SP">São Paulo</option>
                                        <option name="SE" id="estado-se" value="SE">Sergipe</option>
                                        <option name="TO" id="estado-to" value="TO">Tocantins</option>

                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {

            const cepInput = $('.cep');

            cepInput.mask('00000-000');

            cepInput.on('keyup', () => {
                if (cepInput.val().length == 9) {
                    setAdressByCEP();
                }
            });

            function setAdressByCEP() {
                $.ajax({
                    url: `https://webmaniabr.com/api/1/cep/${cepInput.val()}/?app_key=DdR8TRXdBfdCzy2UWhl55frKvYto7kfM&app_secret=oauSTdPT1ikmNp1DFH69GX0jMjEJgqz5QAudshjuawRoXlfZ`,
                    method: "GET",
                    dataType: 'json',
                    success: function(data) {
                        let entries = Object.entries(data);

                        for (let [key, value] of entries) {
                            if (key != 'cep') {
                                if (key == 'uf') {
                                    console.log($('#estado-' + value.toLowerCase()).attr(
                                        'selected', 'selected'));
                                } else {
                                    $('#' + key).val(value);
                                }
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", textStatus, errorThrown);
                    }
                });
            }
        };
    </script>
</body>

</html>

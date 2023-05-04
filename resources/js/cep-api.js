var cepInput = $('.cep');

cepInput.on('keyup', () => {
    if (cepInput.val().length == 9) {
        setAdressByCEP();
    }
});

function setAdressByCEP() {
    $.ajax({
        url: `/cep/${cepInput.val()}`,
        method: "GET",
        dataType: 'json',
        success: function (data) {
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
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
        }
    });
}
function edit_estado(base_url) {
    var estado_id = $("#estado").val();
    $("#cidade").html("");
    if ($.isNumeric(estado_id)) {
        $.ajax({
                 type: "POST",
                 url: base_url + 'pessoa/get_cidades_by_estado/',
                 data: "estado_id="+estado_id,
                 dataType: "json",
                         success: function(data) {                            
                            $.each(data.content, function(i, value) {
                                $("#cidade").append($("<option>").text(value.nome).attr("value", value.id));
                            });
                        },
                        error: function (request, status, error) {                            
                        }
         });    
    }
}
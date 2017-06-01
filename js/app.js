
//create item in database
    function create(){
        var table = $('#create-table').val();
        var action = 'create';
        $.ajax({
            type:"post",
            url:"includes/action.php",
            data:$("#create-item").serialize()+"&table="+table+"&action="+action,
            success:function(data){
                read();
                $('#info').empty();
                $('#info').append(data);
                console.log(data);
            }
        });
    };
    function read(){
        var table = $('#read-table').val();
        var action = 'read';
        $.ajax({
            type:"post",
            url:"includes/action.php",
            data:"&table="+table+"&action="+action,
            success:function(data){
                $("#prikaz").empty();
                $("#prikaz").removeClass("hidden");
                console.log(data);
                var result = $.parseJSON(data);
                $("#prikaz").append("<thead>" +
                    "<th>ID</th>" +
                    "<th>naziv</th>" +
                    "<th>cena</th>" +
                    "<th>update</th>" +
                    "<th>delete</th>" +
                    "</thead>"
                );
                var items = [];
                $.each( result, function( key, val ) {
                    items.push(
                        "<tr>"+
                        "<td>"+ val.id+"</td>"+
                        "<td>"+ val.naziv+
                        "<td>"+val.cena+"</td>"+
                        "<td>"+table+"</td>"+
                        "<td><button type='button' class='btn btn-danger del' onclick='dell("+val.id+",\""+table+"\")'><span class='glyphicon glyphicon-remove'></span> obrisi</button></td>"+
                        "<td><button type='button' class='btn btn-warning' onclick='updatePregled("+val.id+","+table+")' data-toggle='modal' data-target='#promena-pregleda-modal'><span class='glyphicon glyphicon-edit'></span> promeni</button></td>"+
                        "</tr>"
                    );
                });
                $( "<tbody/>", { html: items.join( "" ) }).appendTo( "#prikaz" );
            }
        });
    };
    function dell(id,table){
        var action = 'delete';
        $.ajax({
            type: "POST",
            url: "includes/action.php",
            data: "id="+id+"&table="+table+"&action="+action,
            success: function(data){
                read();
                $('#info').empty();
                $('#info').append(data);
            }
        });
    };
 //>>end of crud
//Forms
$(document.body).on('click',".add-project",function (e) {
    var data = $("#addProject").serialize();
    $.post( "ajax.php", "action=add_project&"+data, function( data ) {
        if(data.status) {
            $(".result-table tbody").append(data.html);
            $("#addProject")[0].reset();
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-user",function (e) {
    var data = $("#addUser").serialize();
    $.post( "ajax.php", "action=add_user&"+data, function( data ) {
        if(data.status) {
            $(".result-table tbody").append(data.html);
            $("#addUser")[0].reset();
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".set-project-user",function (e) {
    var data = $("#setProjectUser").serialize();
    var id = $("#project").val();
    $.post( "ajax.php", "action=set_project_user&"+data, function( data ) {
        if(data.status) {
            $("#project"+id).html(data.html);
            $("#setProjectUser")[0].reset();
            $('#setUser').modal('hide');
        }else{
            $(".error-box-modal").empty() ;
            $(".error-box-modal").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-event",function (e) {
    var data = $("#addEvent").serialize();
    $.post( "ajax.php", "action=add_event&"+data, function( data ) {
        if(data.status) {
            $(".result-table tbody").append(data.html).fadeIn('slow');
            $("#addEvent")[0].reset();
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-event-child",function (e) {
    var data = $("#addEventChild").serialize();
    alert(data);
    $.post( "ajax.php", "action=add_event_child&"+data, function( data ) {
        if(data.status) {
            $(".childTable").append(data.html).fadeIn('slow');
            var event = $("#event").val();
            $("#addEventChild")[0].reset();
            $('#event').val(event);
        }else{
            $(".error-box-modal").empty() ;
            $(".error-box-modal").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-event-argument",function (e) {
    var data = $("#addEventArgument").serialize();
    $.post( "ajax.php", "action=add_event_argument&"+data, function( data ) {
        if(data.status) {
            $(".childTable").append(data.html).fadeIn('slow');
            var event = $("#event").val();
            $("#addEventArgument")[0].reset();
            $('#event').val(event);
        }else{
            $(".error-box-modal").empty() ;
            $(".error-box-modal").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-entity",function (e) {
    var data = $("#addEntity").serialize();
    $.post( "ajax.php", "action=add_entity&"+data, function( data ) {
        if(data.status) {
            $(".result-table tbody").append(data.html).fadeIn('slow');
            $("#addEntity")[0].reset();
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-entity-child",function (e) {
    var data = $("#addEntityChild").serialize();
    $.post( "ajax.php", "action=add_entity_child&"+data, function( data ) {
        if(data.status) {
            $(".childTable").append(data.html).fadeIn('slow');
            var entity = $("#entity").val();
            $("#addEntityChild")[0].reset();
            $('#entity').val(entity);
        }else{
            $(".error-box-modal").empty() ;
            $(".error-box-modal").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".add-phrases",function (e) {
    var data = $("#addPhrases").serialize();
    $.post( "ajax.php", "action=add_phrases&"+data, function( data ) {
        if(data.status) {
            $(".result-table tbody").append(data.html);
            $("#addPhrases")[0].reset();
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('click',".importExcel",function (e) {
    var project = $("#project").val();
    var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('action','importExcel');
    form_data.append('project',project);
    $.ajax({
        url: 'ajax.php',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(data){
            if(data.status) {
                $(".result-table tbody").append(data.html);
                $('#importExcel').modal('hide');
            }else{
                $(".error-box-modal").empty() ;
                $(".error-box-modal").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
            }
        }
    });
});
$(document.body).on('click',".word-button",function (e) {
    var data_value = $(this).data("value");
    var data_type = $(this).data("type");
    $.post( "ajax.php", "action=get_"+data_type+"&words="+data_value, function( data ) {
        if(data.status) {
            $(".words-box").html(data.html);
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");

});
$(document.body).on('change',".set_tens",function (e) {
    var tens_value = $(this).val();
    var event_id = $(this).data('event');
    var $this = $(this);
    $.post( "ajax.php", "action=set_tens&tens="+tens_value+'&event='+event_id, function( data ) {
        if(data.status) {
            $this.addClass('is-valid');
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('change',".set_asserted",function (e) {
    var tens_value = $(this).val();
    var event_id = $(this).data('event');
    var $this = $(this);
    $.post( "ajax.php", "action=set_asserted&asserted="+tens_value+'&event='+event_id, function( data ) {
        if(data.status) {
            $this.addClass('is-valid');
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
$(document.body).on('change',".set_argument",function (e) {
    var argument = $(this).val();
    var words = $(this).data('words');
    var event_id = $(this).data('event');
    var $this = $(this);
    $.post( "ajax.php", "action=set_argument&argument="+argument+'&words='+words+'&event='+event_id, function( data ) {
        if(data.status) {
            $this.addClass('is-valid');
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});
//Modals
$('#setUser').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var project = button.data('project');
    var modal = $(this);
    modal.find('.modal-body #project').val(project);
});
$('#addEntityChildModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var entity = button.data('entity');
    var modal = $(this);
    $.post( "ajax.php", "action=get_entity_child&parent="+entity, function( data ) {
        if(data.status) {
            modal.find('.modal-body #entity').val(entity);
            modal.find('#childTable').html(data.html);
        }else{

        }
    }, "json");
});
$('#userStatistics').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var u_id = button.data('id');
    var modal = $(this);
    $.post( "ajax.php", "action=get_user_statistics&id="+u_id, function( data ) {
        if(data.status) {
            modal.find('.table-statistics tbody').html(data.html);
        }
    }, "json");
});
$('#eventChildren').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var event_id = button.data('parent');
    var modal = $(this);
    $.post( "ajax.php", "action=get_event_child&parent="+event_id, function( data ) {
        if(data.status) {
            modal.find('.modal-body #event').val(event_id);
            modal.find('#childTable').html(data.html);
        }else{

        }
    }, "json");
});
$('#eventArguments').on('show.bs.modal', function (argument) {
    var button = $(argument.relatedTarget);
    var event_id = button.data('parent');
    var modal = $(this);
    $.post( "ajax.php", "action=get_event_argument&event_id="+event_id, function( data ) {
        if(data.status) {
            modal.find('.modal-body #event').val(event_id);
            modal.find('#childTable').html(data.html);
        }else{

        }
    }, "json");
});
//Delete
$(document.body).on('click',".delete-rows",function (e) {
    var id = $(this).data("id");
    var type = $(this).data("type");
    var table_row = $(this).parent().parent();
    $.post( "ajax.php", "action=delete_rows&type="+type+"&id="+id, function( data ) {
        if(data.status) {
            table_row.remove();
        }
    }, "json");
});
$(document.body).on('click',".delete-box",function (e) {
    var id = $(this).data("id");
    var type = $(this).data("type");
    $.post( "ajax.php", "action=delete_rows&type="+type+"&id="+id, function( data ) {
        if(data.status) {
            location.reload();
        }
    }, "json");
});


// Right Click Action
$(function() {
    $.contextMenu({
        selector: '.context-menu-one',
        items: $.contextMenu.fromMenu($('#html5menu')),
        rtl:true
    });
});
function rightClickCallback(key,phrase,type){
    if (typeof window.getSelection != "undefined") {
        var sel = window.getSelection();
        if (sel.rangeCount) {
            var container = document.createElement("div");
            for (var i = 0, len = sel.rangeCount, range; i < len; ++i) {
                range = sel.getRangeAt(i);
                if (range.startContainer === range.endContainer
                    && range.startContainer.nodeType === Node.TEXT_NODE
                    && range.startOffset === 0
                    && range.endOffset === range.startContainer.length) {
                    range.selectNode(range.startContainer.parentElement);
                }
                container.appendChild(range.cloneContents());
            }
            html = container.innerHTML;
        }
    } else if (typeof document.selection != "undefined") {
        if (document.selection.type == "Text") {
            html = document.selection.createRange().htmlText;
        }
    }
    var text = $(html).text().trim();
    if(html){
        var spans = $(html).find("span");
        spans = spans.prevObject;
        var data_id = "";
        var data_value = "";
        if(spans.length > 0) {
            spans.each(function (e) {
                data_value = $(spans[e]).data("value");
                if (data_value)
                    data_id += data_value + ",";
            });
            data_id = data_id.substring(0, data_id.length - 1);
            if (type === "entity")
                var newstr = '<span class="word-button-green word-button" data-type="entity" data-value="' + data_id + '">' + text + '</span> ';
            else
                var newstr = '<span class="word-button-blue word-button" data-type="event" data-value="' + data_id + '">' + text + '</span> ';
            let mystr = $(".context-menu-one").html();
            mystr = mystr.replace(html, newstr);
            $(".context-menu-one").html(mystr);
            $.post( "ajax.php", "action=set_"+type+"&value="+key+"&phrase="+phrase+"&words="+data_id, function( data ) {
                if(data.status) {

                }else{
                    $(".error-box").empty() ;
                    $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
                }
            }, "json");
        }else{
            alert("You selected incorrect word(s)")
        }
    }else{
        alert("Please select a word.")
    }
}
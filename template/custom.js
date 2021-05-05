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
    let reqData = $("#setProjectUser").serialize();
    let id = $("#project").val();
    $.get( "ajax.php?action=set_project_user&"+reqData, function( data, status) {
        data = JSON.parse(data);
        if(data.status) {
            $("#project"+id).html(data.html);
            $("#setProjectUser")[0].reset();
            $('#setUser').modal('hide');
        }else{
            $(".error-box-modal").empty() ;
            $(".error-box-modal").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    });
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
            var event = $("#argument").val();
            $("#addEventArgument")[0].reset();
            $('#argument').val(event);
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
$(document.body).on('change',".set_polarity",function (e) {
    var polarity_value = $(this).val();
    var event_id = $(this).data('event');
    var $this = $(this);
    $.post( "ajax.php", "action=set_polarity&polarity="+polarity_value+'&event='+event_id, function( data ) {
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
    var event_id = button.data('event');
    var modal = $(this);
    $.post( "ajax.php", "action=get_event_argument&event_id="+event_id, function( data ) {
        if(data.status) {
            modal.find('.modal-body #argument').val(event_id);
            modal.find('#argumentTable').html(data.html);
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
$(document.body).on('click',".edit-rows",function (e) {
    let edit_btn = $(this);
    let id = $(this).data("id");
    let type = $(this).data("type");
    let table_row = $(this).parent().parent();
    
    let title = table_row.find('td').eq(1).text();
    let alias = 'test';
    let action = 'edit_row';
    let reqData = {
        id,
        type,
        title,
        alias,
        action
    }
    $.post( "ajax.php", reqData, function( data ) {
        if(data.status) {
            console.log('ok');
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
    let allItems = $.contextMenu.fromMenu($('#html5menu'));
    const createRow = (elementStr) => {
        return function(item, opt, root) {
            $(elementStr)
                .appendTo(this)
                .on('click', 'li', function() {
                    // do some funky stuff
                    console.log('Clicked on ' + $(this).text());
                    // hide the menu
                    let phraseId = $(this).attr('phrase_id')
                    let eventId = $(this).attr('event_id');
                    rightClickCallback(eventId, phraseId, 'event')
                    root.$menu.trigger('contextmenu:hide');
                });
    
            this.addClass('child').on('contextmenu:focus', function(e) {
                // setup some awesome stuff
            }).on('contextmenu:blur', function(e) {
                // tear down whatever you did
            }).on('keydown', function(e) {
                // some funky key handling, maybe?
            });
        };
    }
    const createChildrenMenu = (childrenItems, parentName) => {
        let newChildrenItems = {};
        let lenItems = Object.keys(childrenItems).length;
        let maxRows = 12;
        let numOfRowItems = parseInt((maxRows + lenItems)/maxRows);
        let cnt = 0;
        let tmpElementStr = '';
        for(let keyItem in childrenItems){
            let item = childrenItems[keyItem];
            cnt+=1;
            if(numOfRowItems==1 || cnt%numOfRowItems==1){
                tmpElementStr = '<span><ul>';
            }
            
            let eventId = $('[label="'+item.name+'"]').attr('event_id');
            let phraseId = $('[label="'+item.name+'"]').attr('phrase_id');
            tmpElementStr+='<li class="child" phrase_id="'+phraseId+'" event_id="'+eventId+'" >'+item.name+'</li>';
            if(numOfRowItems==1 || cnt%numOfRowItems==0){
                let groupNumber = parseInt(cnt/numOfRowItems).toString();
                let groupName = (parentName+groupNumber).replace(" ","");
                $.contextMenu.types[groupName] = createRow(tmpElementStr);
                newChildrenItems[groupName] = {type: groupName, customName: ""}; 
            }
        }
        return newChildrenItems;
    }
    for(key in allItems){
        let eventInPersian = "رویداد";
        if(allItems[key].name == 'Event' || allItems[key].name == eventInPersian){
            for(event_key in allItems[key].items){
                eventChildren = allItems[key].items[event_key].items;
                let parentName = allItems[key].items[event_key].name;
                let newChildren = createChildrenMenu(eventChildren, parentName);
                allItems[key].items[event_key].items = newChildren;
            }
        }
    }
    
    $.contextMenu({
        selector: '.context-menu-one',
        items: allItems,//$.contextMenu.fromMenu($('#html5menu')),
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
$(document.body).on('change',".lang_selector",function (e) {
    var lang = $(this).val();
    $.post( "ajax.php", "action=change_lang&lang="+lang, function( data ) {
        console.log(data)
        if(data.status) {
            location.reload();
        }else{
            $(".error-box").empty() ;
            $(".error-box").append(data.message).fadeIn('slow').delay(2000).fadeOut(400);
        }
    }, "json");
});


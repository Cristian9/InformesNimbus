"use strict";
String.prototype.ucfirst = function () {
    return this.charAt(0).toUpperCase() + this.substr(1);
};

String.prototype.lcfirst = function(){
    return this.charAt(0).toLowerCase() + this.substr(1);
};

var herramientas = {
    'documents'         : 'documentos',
    'learnpaths'        : 'mis Clases',
    'links'             : 'enlaces',
    'forums'            : 'foros',
    'announcements'     : 'anuncios',
    'chats'             : 'chat',
    'works'             : 'tareas',
    'quizzes'           : 'evaluaciones',
    'agenda'            : 'agenda',
    'dropbox'           : 'comp. Documentos',
    'survey'            : 'encuesta',
    'groups'            : 'grupos',
    'gradebook'         : 'form. Evaluac.',
    'course_progress'   : 'prog. Didáctica'
};

function getWeeks(){
    var periodo = $('#cbo_periodo').val();
    var category = $('#cbo_cat').val();
    var option = "";
    
    $('#input_date, #input_date2')
        .attr('disabled', true);

    $.getJSON('getweek', {
        periodo: periodo,
        category: category
    })
    .done(function (data) {
        var json = data;
        for (var i = 0; i < json.listas[0]['weeks']; i++) {
            option += "<option ";
            option += "value='" + (i) + "'>";
            option += "Semana " + (i);
            option += "</option>";
        }
        $('#input_date, #input_date2')
            .removeAttr('disabled')
            .select2('val', -1)
            .html(null)
            .append("<option value='-1'>.::: Seleccione :::.</option>")
            .append(option);
    });
}

function graficar(url, params) {
    $('#d_bar').html('Graficando.....');
    var csrf = $.cookie('nbscookie');
    $.ajaxreq({
        url: url,
        type: 'POST',
        params: $.param(params) + '&nbstoken=' + csrf,
        callback: function (e) {
            var json = eval('(' + e + ')');
            var data_chart = [];
            var label_chart = [];
            var data_subto = [];
            var html = "";
            $('#d_bar').html(null);
            for (var item in json[0]) {
                data_chart = [];
                label_chart = [];
                data_subto = [];

                html = "<div class='row'>" +
                        "<div class='col-xs-11 col-sm-11'>" +
                        "<div class='panel panel-default'>" +
                        "<div class='panel-heading'>" + herramientas[item].ucfirst() + "</div>" +
                        "<div class='panel-body'>" +
                        "<div class='canvas-wrapper'>" +
                        "<canvas class='main-chart' id='bar-chart_" + item + "' height='200' width='600'></canvas>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</div>" +
                        "</div>";

                $('#d_bar').append(html);

                for (var item_area in json[0][item]) {
                    label_chart.push(item_area);
                    data_chart.push(json[0][item][item_area]);
                    data_subto[item_area] = json[1][item][0][item_area];
                }

                var facultadesBar = {
                    labels: label_chart,
                    datasets: [
                        {
                            label : data_subto,
                            fillColor: "rgba(48, 164, 255, 0.2)",
                            strokeColor: "rgba(48, 164, 255, 0.8)",
                            highlightFill: "rgba(48, 164, 255, 0.75)",
                            highlightStroke: "rgba(48, 164, 255, 1)",
                            data: data_chart
                        }
                    ]
                };

                var grafico = document.getElementById('bar-chart_' + item).getContext('2d');
                window.myLine = new Chart(grafico).Bar(facultadesBar, {
                    responsive: true,
                    scaleFontSize : 10,
                    //tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>%"
                    tooltipTemplate : function( obj ){
                        var etiqueta = "";
                        etiqueta = obj.value + "%";
                        etiqueta += " ( " + obj.datasetLabel[obj.label];
                        etiqueta += " de " + json[1]['Totales'][0][obj.label] + " )";
                        return etiqueta;
                    }
                });
            }
        }
    });
}

function add_columnas(elem, txt, base) {
    var x = document.getElementById(txt + "_head");

    if (!x) {
        var trh = document.getElementById(elem).tHead.children[0], 
            thh = document.createElement('th');

        thh.innerHTML = herramientas[txt].ucfirst();
        thh.setAttribute('id', txt + "_head");
        trh.appendChild(thh);

        var trf = document.getElementById(elem).tFoot.children[0], 
            thf = document.createElement('th');

        thf.innerHTML = herramientas[txt].ucfirst();
        thf.setAttribute('id', txt + "_foot");
        trf.appendChild(thf);

        if(base == 1){
            var trhb = document.createElement('th');

            trhb.innerHTML = 'Curso Base ' + herramientas[txt].ucfirst();
            trhb.setAttribute('id', txt + "_headbase");
            trh.appendChild(trhb);


            var trfb = document.createElement('th');

            trfb.innerHTML = 'Curso Base ' + herramientas[txt].ucfirst();
            trfb.setAttribute('id', txt + "_footbase");
            trf.appendChild(trfb);
        }
    }
}

function cargar_select(select, url, param) {
    var csrf = $.cookie('nbscookie');
    var select_data = "";
    var serialize = "";
    var parameter = param || null;

    $('#' + select)
        .attr('disabled', true);

    parameter !== null && (serialize = (typeof parameter == 'object') ? $.param(parameter) : 'chk=' + parameter);

    $.ajaxreq({
        url: url,
        type: 'POST',
        params: serialize + '&nbstoken=' + csrf,
        callback: function (e) {
            var json = eval('(' + e + ')');

            for (var cbo = 0; cbo < json.listas.length; cbo++) {
                select_data += "<option value='" +
                        json.listas[cbo]['id'] + "'>" +
                        json.listas[cbo]['id'] + ' - ' +
                        json.listas[cbo]['description'] +
                        "</option>";
            }

            $('#' + select)
                .removeAttr('disabled')
                .append(select_data);
        }
    });
}

function LoadAjaxContent(url) {
    $('.preloader').show();
    var csrf = $.cookie('nbscookie');
    $.ajax({
        mimeType: 'text/html; charset=utf-8',
        url: url,
        data : {
            nbstoken : csrf
        },
        type: 'GET',
        success: function (data) {
            $('#ajax-content').html(data);
            $('.preloader').hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        },
        dataType: "html",
        async: false
    });
}

$(document).ready(function () {
    $('body').on('click', '.show-sidebar', function (e) {
        e.preventDefault();
        $('div#main').toggleClass('sidebar-show');
        setTimeout(MessagesMenuWidth, 250);
    });

    var ajax_url = location.hash.replace(/^#/, '');

    if (ajax_url.length > 1) {
        LoadAjaxContent(ajax_url);
    }

    $('.main-menu').on('click', 'a', function (e) {

        var parents = $(this).parents('li');

        //var another_items = $('.main-menu li');
        var another_items = $('.main-menu li').not(parents);
        another_items.find('a').removeClass('active');
        var li = $(this).closest('li.dropdown');
        another_items.find('a').removeClass('active-parent');

        if ($(this).hasClass('dropdown-toggle') || $(this).closest('li').find('ul').length == 0) {
            $(this).addClass('active-parent');
            var current = $(this).next();
            if (current.is(':visible')) {
                li.find("ul.dropdown-menu").slideUp('fast');
                li.find("ul.dropdown-menu a").removeClass('active');
            } else {
                another_items.find("ul.dropdown-menu").slideUp('fast');
                current.slideDown('fast');
            }
        } else {
            if (li.find('a.dropdown-toggle').hasClass('active-parent')) {
                var pre = $(this).closest('ul.dropdown-menu');
                pre.find("li.dropdown").not($(this).closest('li')).find('ul.dropdown-menu').slideUp('fast');
            }
        }

        if ($(this).hasClass('active') == false) {
            $(this).parents("ul.dropdown-menu").find('a').removeClass('active');
            $(this).addClass('active');
        }
        if ($(this).hasClass('ajax-link')) {
            e.preventDefault();

            if ($(this).hasClass('add-full')) {
                $('#content').addClass('full-content');
            }
            else {
                $('#content').removeClass('full-content');
            }

            var url = $(this).attr('href');
            window.location.hash = url;
            LoadAjaxContent(url);
        }
    });

    var height = window.innerHeight - 49;
    $('#main').css('min-height', height).on('click', '.expand-link', function (e) {
        var body = $('body');
        e.preventDefault();
        var box = $(this).closest('div.box');
        var button = $(this).find('i');
        button.toggleClass('fa-expand').toggleClass('fa-compress');
        box.toggleClass('expanded');
        body.toggleClass('body-expanded');
        var timeout = 0;
        if (body.hasClass('body-expanded')) {
            timeout = 100;
        }
        setTimeout(function () {
            box.toggleClass('expanded-padding');
        }, timeout);

        setTimeout(function () {
            box.resize();
            box.find('[id^=map-]').resize();
        }, timeout + 50);
    }).on('click', '.collapse-link', function (e) {
        e.preventDefault();
        var box = $(this).closest('div.box');
        var button = $(this).find('i');
        var content = box.find('div.box-content');
        content.slideToggle('fast');
        button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        setTimeout(function () {
            box.resize();
            box.find('[id^=map-]').resize();
        }, 50);
    }).on('click', '.close-link', function (e) {
        e.preventDefault();
        var content = $(this).closest('div.box');
        content.remove();
    });
});
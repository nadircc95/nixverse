<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="{{url('falcon')}}/vendors/popper/popper.min.js"></script>
<script src="{{url('falcon')}}/vendors/bootstrap/bootstrap.min.js"></script>
<script src="{{url('falcon')}}/vendors/anchorjs/anchor.min.js"></script>
<script src="{{url('falcon')}}/vendors/is/is.min.js"></script>
<script src="{{url('falcon')}}/vendors/prism/prism.js"></script>
@if (Auth::user())
<script src="{{url('falcon')}}/vendors/jquery/jquery.min.js"> </script>
<script src="{{url('moment')}}/moment.min.js"> </script>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}
<script>
    if (window.jQuery) {
    var $ = window.jQuery;
    $(async function(){
        let _url_all = new URL(location.href);
        let _url_href = new URL(location.href).href;
        await $('nav ul li.nav-item').find('a.nav-link.dropdown-toggle').removeClass('active');

        $('nav ul li.nav-item').find(`a[href="${_url_href}"]`).removeClass('text-700');
        $('nav ul li.nav-item').find(`a[href="${_url_href}"]`).removeClass('link-600');

        $('nav ul li.nav-item').find(`a[href="${_url_href}"]`).addClass('text-primary');

        let gos_1 = $('nav ul li.nav-item').find(`a[href="${_url_href}"].dropdown-item`);
        let breadcrump = [];
        breadcrump[1] = "";
        breadcrump[2] = "";
        breadcrump[3] = "";
        if(gos_1.length > 0){
            let prnt = gos_1.closest('li.nav-item.dropdown').find('a.nav-link.dropdown-toggle');


            breadcrump[1] = `${gos_1.html()}`;
            breadcrump[1] = `<li class="breadcrumb-item name_menu_active" aria-current="page">${breadcrump[1]}</li>`;

            breadcrump[2] = `${prnt.html()}`;
            breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[2]}</li>`;

            prnt.addClass('active');
            // gos_1.addClass('fw-bold');
        }else{
            let gos_2 = $('nav ul li.nav-item').find(`a[href="${_url_href}"].nav-link`);
            // console.log('gos_2', gos_2);
            if(gos_2.length > 0){
                let childs = gos_2.closest('.nav.flex-column').find(`p[data-id="${gos_2.data('parent')}"]`);
                // console.log('childs', childs);
                let prnt = gos_2.closest('li.nav-item.dropdown').find('a.nav-link.dropdown-toggle');

                if(childs.length > 0){



                    breadcrump[2] = `${childs.html()}`;
                    breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[2]}</li>`;

                    breadcrump[3] = `${prnt.html()}`;
                    breadcrump[3] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[3]}</li>`;
                }else{

                    breadcrump[2] = `${prnt.html()}`;
                    breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${breadcrump[2]}</li>`;
                }

                breadcrump[1] = `${gos_2.html()}`;
                breadcrump[1] = `<li class="breadcrumb-item name_menu_active" aria-current="page">${breadcrump[1]}</li>`;

                prnt.addClass('active');
                // gos_2.addClass('fw-bold');

            }

        }

        let ch_title = $('#header_menu .card .card-header .title_ams');
        if(ch_title.length > 0){
            ch_title.html(`
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                ${breadcrump[3]}
                ${breadcrump[2]}
                ${breadcrump[1]}
            </ol>
            </nav>
            `);
        }
    });

    // $(function() {
    //     let _url_all = new URL(location.href);
    //     let _url_href = new URL(location.href).href;

    //     $('nav li.nav-item').find('a.nav-link').removeClass('active');
    //     $('nav li.nav-item').find('ul.nav.collapse').removeClass('show');
    //     $('nav li.nav-item').find('a.nav-link.dropdown-indicator').attr('aria-expanded', 'false');
    //     let gos = $('nav li.nav-item').find(`a[href="${_url_href}"].nav-link`);

    //     if(gos.length > 0){
    //         $.each(gos, function(index, value){
    //             let breadcrump = [];
    //             breadcrump[1] = "";
    //             breadcrump[2] = "";
    //             breadcrump[3] = "";


    //             var _get_text = $(value).find('.nav-link-text').html();
    //             breadcrump[1] = `<li class="breadcrumb-item active" aria-current="page">${_get_text}</li>`;

    //             $(value).addClass('active');
    //             let _parent = $(value).closest('ul.nav.collapse').closest('li.nav-item');
    //             if(_parent.length > 0){

    //                 var _get_text = _parent.find('.nav-link-text').html();
    //                 breadcrump[2] = `<li class="breadcrumb-item active" aria-current="page">${_get_text}</li>`;


    //                 _parent.find('a.nav-link.dropdown-indicator').attr('aria-expanded', 'true');
    //                 _parent.find('ul.nav.collapse').addClass('show');

    //                 let _parent2 = _parent.closest('ul.nav.collapse').closest('li.nav-item');
    //                 if(_parent2.length > 0){
    //                     var _get_text = _parent2.find('.nav-link-text').html();
    //                     breadcrump[3] = `<li class="breadcrumb-item active" aria-current="page">${_get_text}</li>`;

    //                     _parent2.find('a.nav-link.dropdown-indicator').attr('aria-expanded', 'true');
    //                     _parent2.find('ul.nav.collapse').addClass('show');
    //                 }
    //             }

    //             let ch_title = $('.card .card-header h4.title_ams');
    //             if(ch_title.length > 0){
    //                 ch_title.html(`
    //                 <nav aria-label="breadcrumb">
    //                 <ol class="breadcrumb">
    //                     ${breadcrump[3]}
    //                     ${breadcrump[2]}
    //                     ${breadcrump[1]}
    //                 </ol>
    //                 </nav>
    //                 `);
    //             }
    //         });
    //     }

    // });
    }
</script>
<script src="{{url('axios')}}/axios.min.js"></script>

<!-- SweetAlert2 -->
<script src="{{url('swal')}}/sweetalert2/sweetalert2.min.js"></script>
<script>

    let urlActionNow = new URL(location.href).href;
    urlActionNow = urlActionNow.replace(new URL(location.href).search,"");
    urlActionNow = urlActionNow.replace(new URL(location.href).hash,"");

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    let _button_export = function _button_export(_title){
        return [
            {
                extend: 'csv',
                className: 'btn btn-outline-info',
                title: `${_title} ${moment().format("YYYY-MM-DD")}`,
                exportOptions: {
                    columns: ':not(.notexport)'
                },
                init: function(api, node, config) {
                    $(node).removeClass('dt-button')
                }
            },
            {
                extend: 'excelHtml5',
                className: 'btn btn-outline-info',
                title: `${_title} ${moment().format("YYYY-MM-DD")}`,
                exportOptions: {
                    columns: ':not(.notexport)'
                },
                init: function(api, node, config) {
                    $(node).removeClass('dt-button')
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-outline-info',
                title: `${_title} ${moment().format("YYYY-MM-DD")}`,
                exportOptions: {
                    columns: ':not(.notexport)'
                },
                init: function(api, node, config) {
                    $(node).removeClass('dt-button')
                },
                orientation: 'landscape',

                // messageTop: 'PDF created by PDFMake with Buttons for DataTables.'
            }
        ];
    }

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success m-2',
            cancelButton: 'btn btn-danger m-2'
        },
        buttonsStyling: false
    });

    let is_create = "{{Session('is_create',0)}}";
    let is_update = "{{Session('is_update',0)}}";
    let is_delete = "{{Session('is_delete',0)}}";

    function is_session_ref_action(){

        if($(`.lazy`).length > 0){
            $('.lazy').Lazy({
                // your configuration goes here
                scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onFinishedAll: function() {
                if( !this.config("autoDestroy") ){
                    this.destroy();
                }
                },
                beforeLoad: function(element) {
                    // console.log(element,'beforeLoad', 'lazy');
                    element.addClass("bg-secondary bg-gradient bg-opacity-25");
                },
                afterLoad: function(element) {
                    // console.log(element,'afterLoad', 'lazy');
                    element.removeClass("lazy");
                    element.removeClass("bg-secondary");
                    element.removeClass("bg-gradient");
                    element.removeClass("bg-opacity-25");
                },
                onError: function(element) {
                    // console.log(element,'onError', 'lazy');
                }
            });
        }

        if($(`button[data-ref-action]`).length > 0){
            // console.log(`is_create : ${is_create}`);
            if(is_create === "1"){
                $(`button[data-ref-action="save"]`).show();
            }else{
                $(`button[data-ref-action="save"]`).remove();
            }

            // console.log(`is_update : ${is_update}`);
            if(is_update === "1"){
                $(`button[data-ref-action="update"]`).show();
            }else{
                $(`button[data-ref-action="update"]`).remove();
            }

            // console.log(`is_delete : ${is_delete}`);
            if(is_delete === "1"){
                $(`button[data-ref-action="delete"]`).show();
            }else{
                $(`button[data-ref-action="delete"]`).remove();
            }
        }

        if($(`#upload_data`).length > 0){
            if(is_create === "1"){
                $(`button[data-ref-action="upload"]`).show();
                $(`#upload_data`).show();
            }else{
                $(`button[data-ref-action="upload"]`).hide();
                $(`#upload_data`).hide();
            }
        }

        // if($(`#unlock_neraca_saldo`).length > 0 && $(`#lock_neraca_saldo`).length > 0){
        //     if(is_create === "1"){
        //         $(`#unlock_neraca_saldo`).show();
        //         $(`#lock_neraca_saldo`).show();
        //     }else{
        //         $(`#unlock_neraca_saldo`).hide();
        //         $(`#lock_neraca_saldo`).hide();
        //     }
        // }


    }

    async function postData(urlAction, formData){
        try {
            const response = await axios.post(`${urlAction}`, formData, {
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            return {
                error: false,
                i: response
            }
        } catch (error) {
            return {
                error: true,
                i: error
            }
        }
    }

    async function postDataNoJson(urlAction, formData){
        try {
            const response = await axios.post(`${urlAction}`, formData, {
            });
            return {
                error: false,
                i: response
            }
        } catch (error) {
            return {
                error: true,
                i: error
            }
        }
    }

    async function getDatas(urlAction){
        try {
            // return 'nadir';
            const response = await axios.get(`${urlAction}`, {
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            return {
                error: false,
                i: response
            }
        } catch (error) {
            return {
                error: true,
                i: error
            }
        }
    }

    function modalInit(dataCheck = {}){
        // console.log('modalInit');

        if(!dataCheck.hasOwnProperty('modal_db')){
            return;
        }
        let modal_db = dataCheck.modal_db;

        modal_db.find('.modal-body form input').each(function(index, item){
            // console.log(index, item);
            // console.log($(this).attr('name'));

            $(this).val("");
            const _attrs = ["id", "action","_token"];
            if(!_attrs.includes($(this).attr('name'))){
                $(this).removeAttr('readonly');
            }else{
                $(this).attr('readonly',true);
            }

            if($(this).attr('data-tvar') === "int"){
                $(this).val("0");
            }
        });

        modal_db.find('.modal-body form textarea').each(function(index, item){
            $(this).val("");
            $(this).removeAttr('readonly');
        });

        modal_db.find('.modal-body form select').each(function(index, item){
            // let _val_select = $(this).find("option")[0].value;
            // if($(this).hasClass('select2bs5')){
            //     $(this).val(_val_select).trigger('change.select2');
            // }else if($(this).hasClass('select2')){
            //     $(this).val(_val_select).trigger('change.select2');
            // }

            if($(this).hasClass('select2bs5')){

            }

            if($(this).find("option").length > 0){

                if(!dataCheck.hasOwnProperty('_formSelect')){
                    let _val_select = $(this).find("option")[0].value;
                    if($(this).hasClass('select2bs5')){
                        $(this).val(_val_select).trigger('change.select2');
                    }else if($(this).hasClass('select2')){
                        $(this).val(_val_select).trigger('change.select2');
                    }
                }else{
                    let objIndexSelect = dataCheck._formSelect.findIndex(x => x === $(this).attr("name"));
                    if(objIndexSelect >= 0){
                        $(this).val(null).trigger('change.select2');
                    }
                }
            }
        });

        if(dataCheck.hasOwnProperty('quill')){
            dataCheck.quill.root.innerHTML = null;
        }

        if(dataCheck.hasOwnProperty('choice')){
            if(Array.isArray(dataCheck.choice)){
                dataCheck.choice.forEach(element => {
                    element.clearStore();
                });
            }else{
                dataCheck.choice.clearStore();
            }
        }
    }

    function errorPost(_post, modal_db = null){
        if(_post.i.response.data.message === 'validasi'){
            let message_x = '';
            let valid_x = _post.i.response.data.validation;
            Object.keys(valid_x).forEach(function(item, index){
                message_x += `${item} : `;
                valid_x[item].forEach(function(i,x){
                    message_x += `${i}<br>`;
                });
                // message_x += `<br>`;
            });
            Toast.fire({
                icon: 'error',
                title: "Error Validasi"
            })
        }else{
            Toast.fire({
                icon: 'error',
                title: _post.i.response.data.message
            })
        }
        if(_post.i.response.status == 400){
            $.each(_post.i.response.data.validation, function(key, value){
                // if(key === 'image'){

                // }else{
                // }

                if(modal_db!==null){
                    let err_item = modal_db.find(`form [name="${key}"]`);
                    err_item.addClass('is-invalid');

                    let err_form = err_item.parent();
                    if(err_form.length > 0){
                        err_form.append(`<span id="${err_item.attr('id')}-error" class="error invalid-feedback" style="">${value}</span>`);
                    }
                }
            });
        }
    }

    let ConvertStringToHTML = function (str) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(str, 'text/html');
        return doc.body;
    };

    function getRowDataTable(relatedTargetAction, table_master){
        var _tr_table = null;
        var _ch_child = $(relatedTargetAction).closest('tr').hasClass('child');
        if( _ch_child){
            _tr_table = $(relatedTargetAction).closest('tr').prev();
        }else{
            _tr_table = $(relatedTargetAction).closest('tr');
        }
        var _row_data = table_master.row(_tr_table);

        return _row_data.data();
    }

    let modalUpdateDeleteForm = async function modalUpdateDeleteForm(modal_db, dataCheck, ref_action, key, value){
        let _form_type = modal_db.find(`form [name="${key}"]`);
        if(_form_type.length > 0){
            // console.log(_form_type.get(0));
            let _element = _form_type.get(0).localName;

            if(_element === 'input'){
                // modal_db.find(`div.modal-body ${_element}[name="${key}"]`).val(value);
                let _input_form = modal_db.find(`div.modal-body ${_element}[name="${key}"]`);
                _input_form.val(value);

                if(_form_type.get(0).hasAttribute('data-type')){
                    if(_form_type.get(0).getAttribute('data-type') === "currency"){
                        // console.log(_form_type.get(0));
                        _input_form.trigger('blur');
                    }else if(_form_type.get(0).getAttribute('data-type') === "number"){
                        // console.log(_form_type.get(0));
                        _input_form.trigger('blur');
                    }
                }

                if(ref_action === 'delete'){
                    _input_form.attr('readonly', true);
                }

                if(dataCheck.hasOwnProperty('readonly')){
                    if(dataCheck.readonly.includes(_input_form.attr('name'))){
                        _input_form.attr('readonly', true);
                    }
                }

                if(dataCheck.hasOwnProperty('choice')){
                    if(dataCheck.hasOwnProperty('choice_name')){
                        if(dataCheck.choice_name.includes(_input_form.attr('name'))){
                            if(Array.isArray(dataCheck.choice)){
                                let _indC = dataCheck.choice_name.indexOf(_input_form.attr('name'));
                                dataCheck.choice[_indC].setValue(value.split('~@~'));
                            }else{
                                dataCheck.choice.setValue(value.split('~@~'));
                            }
                        }
                    }
                }

                // if(_input_form.attr('name') == 'name'){
                //     _input_form.attr('readonly', true);
                // }
            }else if(_element === 'textarea'){
                let _textarea_form = modal_db.find(`div.modal-body ${_element}[name="${key}"]`);
                _textarea_form.val(value);
                if(ref_action === 'delete'){
                    _textarea_form.attr('readonly', true);
                }
            }else if(_element === 'select'){
                // console.log().attr('class'));
                let _select_x = $(_form_type.get(0));
                if(value === true){
                    value = 1;
                }else if(value === false){
                    value = 0;
                }else if(value === null){
                    value = 0;
                }
                if(_select_x.hasClass('select2bs5')){
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2bs5`).val(value).trigger('change.select2');
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2bs5`).val(value).trigger('change');
                }else if(_select_x.hasClass('select2')){
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2`).val(value).trigger('change.select2');
                    modal_db.find(`div.modal-body ${_element}[name="${key}"].select2`).val(value).trigger('change');
                }
                // _form_type.get(0).value = value;
            }



        }else if(dataCheck.hasOwnProperty('quill') && dataCheck.hasOwnProperty('content')){
            if(key === dataCheck.content){
                // dataCheck.quill.root.innerHTML = value;
                let initialContent = dataCheck.quill.clipboard.convert(value);
                await dataCheck.quill.setContents(initialContent, 'silent');

                // $('.lazy').Lazy({
                //     // your configuration goes here
                //     scrollDirection: 'vertical',
                //     effect: 'fadeIn',
                //     visibleOnly: true,
                //     onFinishedAll: function() {
                //     if( !this.config("autoDestroy") ){
                //         this.destroy();
                //     }
                //     },
                //     beforeLoad: function(element) {
                //         // console.log(element,'beforeLoad', 'lazy');
                //         element.addClass("bg-secondary bg-gradient bg-opacity-25");
                //     },
                //     afterLoad: function(element) {
                //         // console.log(element,'afterLoad', 'lazy');
                //         element.removeClass("lazy");
                //         element.removeClass("bg-secondary");
                //         element.removeClass("bg-gradient");
                //         element.removeClass("bg-opacity-25");
                //     },
                //     onError: function(element) {
                //         // console.log(element,'onError', 'lazy');
                //     }
                // });
            }
        }
    }

    function modalUpdateDelete(dataCheck = {}){

        if(!dataCheck.hasOwnProperty('relatedTargetAction')){
            return;
        }
        let relatedTargetAction = dataCheck.relatedTargetAction;

        if(!dataCheck.hasOwnProperty('table_master')){
            return;
        }
        let table_master = dataCheck.table_master;

        if(!dataCheck.hasOwnProperty('modal_db')){
            return;
        }
        let modal_db = dataCheck.modal_db;

        if(!dataCheck.hasOwnProperty('ref_action')){
            return;
        }
        let ref_action = dataCheck.ref_action;

        var _tr_table = null;
        var _ch_child = $(relatedTargetAction).closest('tr').hasClass('child');
        if( _ch_child){
            _tr_table = $(relatedTargetAction).closest('tr').prev();
        }else{
            _tr_table = $(relatedTargetAction).closest('tr');
        }

        var _row_data = table_master.row(_tr_table);
        relatedTargetAction = _tr_table;
        // console.log(_row_data.data());
        
        $.each(_row_data.data(), function(key, value){
            // console.log(`${key} => ${value}`);

            let _key = "";
            let _value = "";
            if(key === "translations"){
                let _translations = _row_data.data().translations;
                let _lang = modal_db.find(`form [name="lang"]`);
                if(_lang.length > 0){

                }else{
                    $.each(_translations, function(kT, vT){
                        // console.log(`${kT} => ${vT}`);

                        $.each(_translations[kT], function(kT2, vT2){
                            // console.log(`${kT2} => ${vT2}`);
                            _key = `t_${kT}_${kT2}`;
                            _value = `${vT2}`;
                            modalUpdateDeleteForm(modal_db, dataCheck, ref_action, _key, _value);

                        });

                    });
                }
            }else{
                modalUpdateDeleteForm(modal_db, dataCheck, ref_action, key, value);
            }

            // let _form_type = modal_db.find(`form [name="${key}"]`);
            // if(_form_type.length > 0){
            //     // console.log(_form_type.get(0));
            //     let _element = _form_type.get(0).localName;

            //     if(_element === 'input'){
            //         // modal_db.find(`div.modal-body ${_element}[name="${key}"]`).val(value);
            //         let _input_form = modal_db.find(`div.modal-body ${_element}[name="${key}"]`);
            //         _input_form.val(value);

            //         if(_form_type.get(0).hasAttribute('data-type')){
            //             if(_form_type.get(0).getAttribute('data-type') === "currency"){
            //                 // console.log(_form_type.get(0));
            //                 _input_form.trigger('blur');
            //             }else if(_form_type.get(0).getAttribute('data-type') === "number"){
            //                 // console.log(_form_type.get(0));
            //                 _input_form.trigger('blur');
            //             }
            //         }

            //         if(ref_action === 'delete'){
            //             _input_form.attr('readonly', true);
            //         }

            //         if(dataCheck.hasOwnProperty('readonly')){
            //             if(dataCheck.readonly.includes(_input_form.attr('name'))){
            //                 _input_form.attr('readonly', true);
            //             }
            //         }

            //         // if(_input_form.attr('name') == 'name'){
            //         //     _input_form.attr('readonly', true);
            //         // }
            //     }else if(_element === 'textarea'){
            //         let _textarea_form = modal_db.find(`div.modal-body ${_element}[name="${key}"]`);
            //         _textarea_form.val(value);
            //         if(ref_action === 'delete'){
            //             _textarea_form.attr('readonly', true);
            //         }
            //     }else if(_element === 'select'){
            //         // console.log().attr('class'));
            //         let _select_x = $(_form_type.get(0));
            //         if(value === true){
            //             value = 1;
            //         }else if(value === false){
            //             value = 0;
            //         }else if(value === null){
            //             value = 0;
            //         }
            //         if(_select_x.hasClass('select2bs5')){
            //             modal_db.find(`div.modal-body ${_element}[name="${key}"].select2bs5`).val(value).trigger('change.select2');
            //             modal_db.find(`div.modal-body ${_element}[name="${key}"].select2bs5`).val(value).trigger('change');
            //         }else if(_select_x.hasClass('select2')){
            //             modal_db.find(`div.modal-body ${_element}[name="${key}"].select2`).val(value).trigger('change.select2');
            //             modal_db.find(`div.modal-body ${_element}[name="${key}"].select2`).val(value).trigger('change');
            //         }
            //         // _form_type.get(0).value = value;
            //     }



            // }else if(dataCheck.hasOwnProperty('quill') && dataCheck.hasOwnProperty('content')){
            //     if(key === dataCheck.content){
            //         // dataCheck.quill.root.innerHTML = value;
            //         let initialContent = dataCheck.quill.clipboard.convert(value);
            //         dataCheck.quill.setContents(initialContent, 'silent');
            //     }
            // }
        });

        modal_db.find('div.modal-body input[name="id"]').val(_row_data.data().id);


        // load image dropzone
        {
            if(dataCheck.hasOwnProperty('myDropzoneImage')){
                let myDropzoneImage = dataCheck.myDropzoneImage;
                if(_row_data.data().image == null){
                    return;
                }
                var mockFile = {
                    name: _row_data.data().image.filename_original,
                    size: _row_data.data().image.filesize,
                };

                let callback = null; // Optional callback when it's done
                let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = true; // Tells Dropzone whether it should resize the image first

                myDropzoneImage.displayExistingFile(mockFile, `${_row_data.data().image_id}`, callback, crossOrigin, resizeThumbnail);
                myDropzoneImage.files.push(mockFile);
                myDropzoneImage.emit("success", mockFile, {
                    success: true,
                    error: false,
                    id_image: _row_data.data().image.id,
                    filename_new: _row_data.data().image.filename_new,
                    url: _row_data.data().image_id,
                });
                myDropzoneImage.emit("complete", mockFile);
            }
        }
        // end image dropzone

        return _row_data.data();
    }
</script>
@endif
@stack('script_bottom')
@stack('script_quill')
@stack('script_add')
<script src="{{url('falcon')}}/vendors/fontawesome/all.min.js"></script>
<script src="{{url('falcon')}}/vendors/lodash/lodash.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{url('falcon')}}/vendors/list.js/list.min.js"></script>
<script src="{{url('falcon')}}/assets/js/theme.js"></script>

<script src="{{url('assets')}}/jquery-lazy/jquery.lazy.min.js"></script>
<script>
    if (window.jQuery) {
      var $ = window.jQuery;

      $(document).ready(async function () {

        console.log('ready');

        $('.lazy').Lazy({
            // your configuration goes here
            scrollDirection: 'vertical',
            effect: 'fadeIn',
            visibleOnly: true,
            onFinishedAll: function() {
              if( !this.config("autoDestroy") ){
                this.destroy();
              }
            },
            beforeLoad: function(element) {
                // console.log(element,'beforeLoad', 'lazy');
                element.addClass("bg-secondary bg-gradient bg-opacity-25");
            },
            afterLoad: function(element) {
                // console.log(element,'afterLoad', 'lazy');
                element.removeClass("lazy");
                element.removeClass("bg-secondary");
                element.removeClass("bg-gradient");
                element.removeClass("bg-opacity-25");
            },
            onError: function(element) {
                // console.log(element,'onError', 'lazy');
            }
        });

      });
    }else{
      console.log("no jquery");
    }
</script>

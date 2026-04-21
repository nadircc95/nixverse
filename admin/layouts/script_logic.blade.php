@php
    $css_js = array_map('strtolower',$css_js ?? []);
@endphp

    @if (in_array("quill", $css_js))
        @section('modal_second')
        <x-modal.modal-blank ::id="modal_blank_quill" ::title="UPLOAD IMAGE">
            <div class="form-group">
                <div id="action_images_quill" class="row">
                    <div class="col-lg-6">
                    <div class="btn-group w-100">
                        <span class="btn btn-success col fileinput-button-quill">
                        <i class="fas fa-plus"></i>
                        <span>Add files</span>
                        </span>
                    </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                    <div class="fileupload-process w-100">
                        <div id="total-progress-quill" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="table table-striped files" id="preview_images_quill">
                    <div id="template_images_quill" class="row mt-2">
                        <div class="col-auto">
                            <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                        </div>
                        <div class="col d-flex align-items-center">
                            <p class="mb-0">
                            <span class="lead" data-dz-name></span>
                            (<span data-dz-size></span>)
                            </p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                        <div class="col-4 d-flex align-items-center">
                            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-center">
                        <div class="btn-group">
                            <button class="btn btn-primary start">
                            <i class="fas fa-upload"></i>
                            <span>Start</span>
                            </button>
                            <button data-dz-remove class="btn btn-danger delete">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-modal.modal-blank>
        @endsection

        @push('script_quill')
            <script type="text/javascript">

                let quillSelect = 0;
                let quill_editor = null;
                let image_contents = [];
                let image_contents_dl = [];
                let start_modal_image = 0;


                $(document).ready(function(){
                    let modal_quill = $(`#modal_blank_quill`);
                    let BlockEmbed = Quill.import('blots/block/embed');

                    class ImageBlot extends BlockEmbed {
                        static create(value) {
                            let node = super.create();
                            node.setAttribute('class', value.class);
                            node.setAttribute('src', `{{url('image/get')}}/${value.id_img}`);
                            // node.setAttribute('data-src', `{{url('image/get')}}/${value.id_img}`);
                            node.setAttribute('width', value.width);
                            node.setAttribute('data-id_img', value.id_img);
                            return node;
                        }

                        static value(node) {
                            return {
                                class: node.getAttribute('class'),
                                url: node.getAttribute('src'),
                                width: node.getAttribute('width'),
                                src: node.getAttribute('data-src'),
                                id_img: node.getAttribute('data-id_img'),
                            };
                        }
                    }
                    ImageBlot.blotName = 'image';
                    ImageBlot.tagName = 'img';
                    Quill.register(ImageBlot);

                    class VideoBlot extends BlockEmbed {
                        static create(url) {
                            let node = super.create();

                            // Set non-format related attributes with static values
                            node.setAttribute('frameborder', '0');
                            node.setAttribute('allowfullscreen', true);

                            return node;
                        }

                        static formats(node) {
                            // We still need to report unregistered embed formats
                            let format = {};
                            if (node.hasAttribute('height')) {
                                format.height = node.getAttribute('height');
                            }
                            if (node.hasAttribute('width')) {
                                format.width = node.getAttribute('width');
                            }
                            return format;
                        }

                        static value(node) {
                            return node.getAttribute('src');
                        }

                        format(name, value) {
                            // Handle unregistered embed formats
                            if (name === 'height' || name === 'width') {
                                if (value) {
                                    this.domNode.setAttribute(name, value);
                                } else {
                                    this.domNode.removeAttribute(name, value);
                                }
                            } else {
                                super.format(name, value);
                            }
                        }
                    }
                    VideoBlot.blotName = 'video';
                    VideoBlot.tagName = 'iframe';

                    var toolbarOptions = [
                        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                        ['blockquote', 'code-block'],
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }], // custom button values
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'script': 'sub'
                        }, {
                            'script': 'super'
                        }], // superscript/subscript
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }], // outdent/indent
                        [{
                            'direction': 'rtl'
                        }], // text direction

                        [{
                            'size': ['small', false, 'large', 'huge']
                        }], // custom dropdown
                        ['link', 'image', 'video', 'formula'],

                        [{
                            'color': []
                        }, {
                            'background': []
                        }], // dropdown with defaults from theme
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],

                        ['clean'] // remove formatting button
                    ];

                    let quillDropzone = null;
                    let _path_image_quill = "s";


                    @if (in_array("quill_blog", $css_js))
                    _path_image_quill = "img/blog";
                    quillDropzone = quillDropZoneImage({'modal_quill': modal_quill,'path_image':`${_path_image_quill}`});
                    @endif

                    @if (in_array("quill_produk", $css_js))
                        @if ($settings['toko'] !== null)
                        toolbarOptions = [
                            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                            [{'header': [1, 2, 3, 4, 5, 6, false]}],
                            ['blockquote'],
                            [{'list': 'ordered'}, {'list': 'bullet'}],
                            [{'script': 'sub'}, {'script': 'super'}], // superscript/subscript
                            [{'indent': '-1'}, {'indent': '+1'}], // outdent/indent
                            [{'direction': 'rtl'}], // text direction
                            [{'color': []}, {'background': []}], // dropdown with defaults from theme
                            [{'font': []}],[{'align': []}],
                            ['clean'] // remove formatting button
                        ];
                        // _path_image_quill = "dokumen/image/market/produk/"+"{{$settings['id_toko']}}"+"-deskripsi";
                        @endif
                    @endif

                    quill_editor = new Quill('#editor_quill', {
                        debug: 'warn',
                        modules: {
                            formula: true,
                            syntax: true,
                            'history': { // Enable with custom configurations
                                'delay': 2500,
                                'userOnly': true
                            },
                            toolbar: toolbarOptions,
                            // imageDrop: true,
                            imageResize: {
                                displayStyles: {
                                    backgroundColor: 'black',
                                    border: 'none',
                                    color: 'white'
                                },
                                modules: ['Resize', 'DisplaySize', 'Toolbar'],
                            }
                        },
                        placeholder: 'write here content...',
                        theme: 'snow'
                    });

                    @if (in_array("quill_blog", $css_js))
                        quill_editor.getModule('toolbar').addHandler('image', () => {
                            quillSelect = quill_editor.getSelection();
                            modal_quill.modal('show');
                        });

                        modal_quill.on("shown.bs.modal", function(event){
                            event.preventDefault();
                            console.clear();
                            modal_quill.find(`.modal-footer button.btn_submit`).hide();
                            let pjg = image_contents_dl.length + image_contents.length;

                            quillDropzone.files.forEach(function(item){
                                quillDropzone.softRemoveFile(item);
                            });

                            if(pjg >= 5){
                                Toast.fire({
                                    icon: 'warning',
                                    title: "Image Content Sudah Cukup"
                                });
                                modal_quill.modal('hide');
                                return;
                            }
                        });

                        $(document).on('click', '#modal_blank_quill .modal-footer button.btn_submit', function(event){
                            event.preventDefault();
                        });
                    @endif

                });
                @if (in_array("quill_blog", $css_js))
                function quillDropZoneImage(dataCheck = {}){

                    // Get the template_images HTML and remove it from the doumenthe template_images HTML and remove it from the doument
                    var previewNode = document.querySelector("#template_images_quill");
                    previewNode.id = "";
                    var previewTemplate = previewNode.parentNode.innerHTML;
                    previewNode.parentNode.removeChild(previewNode);

                    document.querySelector("#total-progress-quill").style.opacity = "0"

                    var maxFiles = 1;
                    var maxFilesize = 10;
                    var myDropzoneImage = new Dropzone("#action_images_quill", {
                        url: "{{route('image.upload')}}", // Set the url for your upload script location
                        acceptedFiles: "image/*",
                        paramName: "file", // The name that will be used to transfer the file
                        maxFiles: maxFiles,
                        timeout: 0,
                        maxFilesize: maxFilesize, // MB
                        parallelUploads: maxFiles,
                        previewTemplate: previewTemplate,
                        autoQueue: false, // Make sure the files aren't queued until manually added
                        previewsContainer: "#preview_images_quill", // Define the container to display the preview_images
                        clickable: ".fileinput-button-quill", // Define the element that should be used as click trigger to select files.
                        init: function() {
                            myThis = this;
                        },
                        softremovedfile: function(file){
                            myThis = this;

                            if (file.previewElement != null && file.previewElement.parentNode != null) {
                                file.previewElement.parentNode.removeChild(file.previewElement);
                            }
                            return myThis._updateMaxFilesReachedClass;
                            var fileRef = file.previewElement;

                            if(fileRef!=null){
                                fileRef.parentNode.removeChild(file.previewElement);
                                return this._updateMaxFilesReachedClass;
                            }

                            return void 0;


                            return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        },
                        removedfile: function(file){
                            myThis = this;
                            var name = '';
                            var id_image = '';
                            if(file.previewElement.id != ""){
                                name = file.previewElement.id;
                                id_image = file.previewElement.getAttribute('data-id_image');
                            }else{
                                if (file.previewElement != null && file.previewElement.parentNode != null) {
                                    file.previewElement.parentNode.removeChild(file.previewElement);
                                }
                                return myThis._updateMaxFilesReachedClass;
                            }
                            var sdt = $.ajax({
                                type: 'POST',
                                url: "{{route('image.delete')}}",
                                data: {
                                    filename: name,
                                    id_image: id_image,
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function (data){
                                    // console.log("File has been successfully removed!!");
                                    // return true;
                                },
                                error: function(e) {
                                    // console.log(e);
                                    // return false;
                            }});
                            sdt.done(function(data){
                                if (file.previewElement != null && file.previewElement.parentNode != null) {
                                    file.previewElement.parentNode.removeChild(file.previewElement);
                                }
                                return myThis._updateMaxFilesReachedClass;
                            });

                            sdt.fail(function(data){
                                if (file.previewElement != null && file.previewElement.parentNode != null) {
                                    file.previewElement.parentNode.removeChild(file.previewElement);
                                }
                                return myThis._updateMaxFilesReachedClass;
                            });
                        },
                    });

                    myDropzoneImage.on("addedfile", function(file){
                        if (myDropzoneImage.files.length > maxFiles) {
                            console.log('addedfile', myDropzoneImage.files.length);
                            this.removeFile(file);
                        }else{
                            file.previewElement.querySelector(".start").onclick = function(e) {
                                e.preventDefault();
                                myDropzoneImage.enqueueFile(file)
                            }
                        }
                    });

                    // myDropzoneImage.enqueueFile()

                    // Update the total progress bar
                    myDropzoneImage.on("totaluploadprogress", function(progress) {
                        document.querySelector("#total-progress-quill .progress-bar").style.width = progress + "%"
                    })

                    myDropzoneImage.on("success", function(file, response){
                        if(!response.error){
                            if(response.hasOwnProperty('success')){
                                file.status = Dropzone.SUCCESS;
                                file.previewElement.querySelector(".start").setAttribute('disabled', 'disabled');
                                file.previewElement.querySelector(".progress").querySelector('.progress-bar').style.width = '100%';
                            }

                            if(dataCheck.hasOwnProperty('modal_quill')){
                                quill_editor.setSelection(quillSelect, 0);
                                const range = quill_editor.getSelection();
                                if (range) {
                                    quill_editor.insertEmbed(range.index, 'image', {
                                        url: response.url,
                                        class: 'aligncenter lazy',
                                        width: '350',
                                        id_img: response.id_image,
                                    }, Quill.sources.USER);
                                    dataCheck.modal_quill.modal('hide');
                                }
                            }
                            file.previewElement.id = response.filename_new;
                            file.previewElement.setAttribute('data-id_image', response.id_image);
                            file.previewElement.setAttribute('data-url', response.url);
                            image_contents.push({
                                'filename' : response.filename_new,
                                'id_image' : response.id_image,
                                'url' : response.url,
                            });

                        }
                    });

                    myDropzoneImage.on("error", function(file, response){
                        if(file.accepted){

                            if(response.error){
                                $(file.previewElement).find('[data-dz-errormessage]').addClass('ml-2');
                                $(file.previewElement).find('[data-dz-errormessage]').html('Failed');
                                if(response.status === "VALIDATION"){

                                }else{

                                }
                            }
                        }
                    });

                    myDropzoneImage.on("sending", function (file, xhr, formData) {
                        formData.append("_token", "{{ csrf_token() }}");
                        if(dataCheck.hasOwnProperty("path_image")){
                            formData.append("path", dataCheck.path_image);
                        }else{
                            formData.append("path", "img/other");
                        }
                        formData.append("filesize", file.size);
                        formData.append("active", 1);

                        // Show the total progress bar when upload starts
                        document.querySelector("#total-progress-quill").style.opacity = "1"
                        // And disable the start button
                        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
                    });

                    // Hide the total progress bar when nothing's uploading anymore
                    myDropzoneImage.on("queuecomplete", function(progress) {
                        document.querySelector("#total-progress-quill").style.opacity = "0";
                    });

                    // document.querySelector("#action_images_quill .start").onclick = function(e) {
                    //     e.preventDefault();
                    //     myDropzoneImage.enqueueFiles(myDropzoneImage.getFilesWithStatus(Dropzone.ADDED))
                    // }
                    // document.querySelector("#action_images_quill .cancel").onclick = function(e) {
                    //     e.preventDefault();
                    //     myDropzoneImage.removeAllFiles(true)
                    // }

                    return myDropzoneImage;
                    // END DROPZONE
                }
                @endif
            </script>
        @endpush

    @endif

    @if (in_array("datatables", $css_js))

    @endif

{{-- START PUSH script_top --}}
@push('script_top')

    @if (in_array("choice", $css_js))
    <!-- Choices JS -->
    <link rel="stylesheet" href="{{url('assets')}}/choice/base.min.css">
    <link rel="stylesheet" href="{{url('assets')}}/choice/choices.min.css">
    @endif

    @if (in_array("dropzone", $css_js))
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{url('assets')}}/dropzone/min/dropzone.min.css">
    @endif

    @if (in_array("quill", $css_js))
    <!-- QUILL EDIT-->
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/quill/quill.custom.css">
    @endif

    @if (in_array("glightbox", $css_js))
    <!-- GLightbox JS -->
    <link rel="stylesheet" href="{{url('falcon')}}/vendors/glightbox/glightbox.min.css">
    @endif

    @if (in_array("select2", $css_js))
    <link href="{{url('falcon')}}/vendors/select2/select2.min.css" rel="stylesheet">
    <link href="{{url('falcon')}}/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css" rel="stylesheet">
    @endif

    @if (in_array("choices", $css_js))
    <link href="{{url('falcon')}}/vendors/choices/choices.min.css" rel="stylesheet" />
    @endif

    @if (in_array("datatables", $css_js))
    <link href="{{url('falcon')}}/vendors/datatables.net-bs5/1.13.1/dataTables.bootstrap5.min.css" rel="stylesheet">
    {{-- <link href="{{url('falcon')}}/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
    <link href="{{url('falcon')}}/vendors/datatables.net-responsive/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{url('datatables')}}/buttons.dataTables.min.css" rel="stylesheet">
    @endif

    @if (in_array("flatpickr", $css_js))
    <link href="{{url('falcon')}}/vendors/flatpickr/flatpickr.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.11/dist/plugins/monthSelect/style.css">
    @endif

    @if (in_array("fullcalendar", $css_js))
    <link href="{{url('falcon')}}/vendors/fullcalendar/main.min.css" rel="stylesheet" />
    @endif

    @if (in_array("leaflet", $css_js))
    <link href="{{url('falcon')}}/vendors/leaflet/leaflet.css" rel="stylesheet">
    <link href="{{url('falcon')}}/vendors/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
    <link href="{{url('falcon')}}/vendors/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
    @endif

    {{-- bottom --}}
    {{-- <link href="{{url('falcon')}}/vendors/prism/prism-okaidia.css" rel="stylesheet"> --}}
@endpush
{{-- END PUSH script_top --}}



{{-- START PUSH script_bottom --}}
@push('script_bottom')
    {{-- top --}}
    {{-- <script src="{{url('falcon')}}/vendors/jquery/jquery.min.js"> </script> --}}
    {{-- <script src="{{url('falcon')}}/vendors/jquery/jquery-3.6.0.min.js"> </script> --}}
    @if (in_array("choice", $css_js))
    <!-- Choices JS -->
    <script src="{{url('assets')}}/choice/choices.min.js"></script>
    <style>
        .font-size-ch{
            font-size: 100%;
        }
    </style>
    <script type="text/javascript">
        function getChoices(dataCheck = {}){
            if(dataCheck.hasOwnProperty('id')){
                let _delimiter = '~@~';
                let _maxItemCount = 10;
                let _placeholder = true;
                let _placeholderValue = null;
                if(dataCheck.hasOwnProperty('delimiter')){
                    _delimiter = dataCheck.delimiter;
                }

                if(dataCheck.hasOwnProperty('maxItemCount')){
                    _maxItemCount = dataCheck.maxItemCount;
                }

                if(dataCheck.hasOwnProperty('placeholder')){
                    _placeholder = dataCheck.placeholder;
                }

                if(dataCheck.hasOwnProperty('placeholderValue')){
                    _placeholderValue = dataCheck.placeholderValue;
                }
                let element = $(`${dataCheck.id}`);
                if(element.length > 0){
                    element = element[0];
                    // console.log(element);
                    let choices = new Choices(element, {
                        delimiter: _delimiter,
                        editItems: false,
                        maxItemCount: _maxItemCount,
                        removeItemButton: true,
                        addItems: true,
                        placeholder: _placeholder,
                        placeholderValue: _placeholderValue,
                        classNames: {
                            item: `badge rounded-pill badge-soft-primary ms-1 me-1 mb-1 font-size-ch`
                        },
                        uniqueItemText: (value) => {
                            return `${value} is ready, can be added`;
                        },
                        maxItemText: (maxItemCount) => {
                            return `Only ${maxItemCount} values can be added`;
                        },
                        duplicateItemsAllowed: false,
                    });
                    // let choices = new Choices(element, {
                    //     silent: false,
                    //     items: [],
                    //     choices: [],
                    //     renderChoiceLimit: -1,
                    //     maxItemCount: 10,
                    //     addItems: true,
                    //     addItemFilter: null,
                    //     removeItems: true,
                    //     removeItemButton: false,
                    //     editItems: false,
                    //     allowHTML: true,
                    //     duplicateItemsAllowed: false,
                    //     delimiter: ',',
                    //     paste: true,
                    //     searchEnabled: true,
                    //     searchChoices: true,
                    //     searchFloor: 1,
                    //     searchResultLimit: 4,
                    //     searchFields: ['label', 'value'],
                    //     position: 'auto',
                    //     resetScrollPosition: true,
                    //     shouldSort: true,
                    //     shouldSortItems: false,
                    //     sorter: () => {},
                    //     placeholder: true,
                    //     placeholderValue: null,
                    //     searchPlaceholderValue: null,
                    //     prependValue: null,
                    //     appendValue: null,
                    //     renderSelectedChoices: 'auto',
                    //     loadingText: 'Loading...',
                    //     noResultsText: 'No results found',
                    //     noChoicesText: 'No choices to choose from',
                    //     itemSelectText: 'Press to select',
                    //     uniqueItemText: 'Only unique values can be added',
                    //     customAddItemText: 'Only values matching specific conditions can be added',
                    //     addItemText: (value) => {
                    //     return `Press Enter to add <b>"${value}"</b>`;
                    //     },
                    //     maxItemText: (maxItemCount) => {
                    //     return `Only ${maxItemCount} values can be added`;
                    //     },
                    //     valueComparer: (value1, value2) => {
                    //     return value1 === value2;
                    //     },
                    //     classNames: {
                    //     containerOuter: 'choices',
                    //     containerInner: 'choices__inner',
                    //     input: 'choices__input',
                    //     inputCloned: 'choices__input--cloned',
                    //     list: 'choices__list',
                    //     listItems: 'choices__list--multiple',
                    //     listSingle: 'choices__list--single',
                    //     listDropdown: 'choices__list--dropdown',
                    //     item: 'choices__item',
                    //     itemSelectable: 'choices__item--selectable',
                    //     itemDisabled: 'choices__item--disabled',
                    //     itemChoice: 'choices__item--choice',
                    //     placeholder: 'choices__placeholder',
                    //     group: 'choices__group',
                    //     groupHeading: 'choices__heading',
                    //     button: 'choices__button',
                    //     activeState: 'is-active',
                    //     focusState: 'is-focused',
                    //     openState: 'is-open',
                    //     disabledState: 'is-disabled',
                    //     highlightedState: 'is-highlighted',
                    //     selectedState: 'is-selected',
                    //     flippedState: 'is-flipped',
                    //     loadingState: 'is-loading',
                    //     noResults: 'has-no-results',
                    //     noChoices: 'has-no-choices'
                    //     },
                    //     // Choices uses the great Fuse library for searching. You
                    //     // can find more options here: https://fusejs.io/api/options.html
                    //     fuseOptions: {
                    //     includeScore: true
                    //     },
                    //     labelId: '',
                    //     callbackOnInit: null,
                    //     callbackOnCreateTemplates: null
                    // });
                    return choices;
                }
                // const element = document.querySelector('.js-choice');
            }
            return null;
        }
    </script>
    @endif

    @if (in_array("dropzone", $css_js))
    <!-- dropzonejs -->
    <script src="{{url('assets')}}/dropzone/dropzone.js"></script>
    {{-- <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script> --}}
    @endif

    @if (in_array("quill", $css_js))
    <!-- QUILL EDIT-->
    <script type="text/javascript" src="{{url('assets')}}/quill/highlight.min.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/quill/quill.min.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/quill/katex.min.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/quill/image-resize.min.js"></script>
    @endif

    @if (in_array("select2", $css_js))
    <script src="{{url('falcon')}}/vendors/select2/select2.min.js"> </script>
    <script src="{{url('falcon')}}/vendors/select2/select2.full.min.js"> </script>
    @endif

    @if (in_array("choices", $css_js))
    <script src="{{url('falcon')}}/vendors/choices/choices.min.js"></script>
    @endif

    @if (in_array("datatables", $css_js))
    {{-- <script src="{{url('falcon')}}/vendors/datatables.net/1.13.1/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="{{url('falcon')}}/vendors/datatables.net-bs5/1.13.1/dataTables.bootstrap5.min.js"> </script> --}}
    <script src="{{url('falcon')}}/vendors/datatables.net/jquery.dataTables.min.js"></script>
    <script src="{{url('falcon')}}/vendors/datatables.net-responsive/dataTables.responsive.min.js"></script>
    <script src="{{url('falcon')}}/vendors/datatables.net-bs5/dataTables.bootstrap5.min.js"> </script>
    <script src="{{url('falcon')}}/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js"> </script>

    <script src="{{url('datatables')}}/dataTables.buttons.min.js"> </script>
    <script src="{{url('datatables')}}/jszip.min.js"> </script>
    <script src="{{url('datatables')}}/pdfmake.min.js"> </script>
    <script src="{{url('datatables')}}/vfs_fonts.js"> </script>
    <script src="{{url('datatables')}}/buttons.html5.min.js"> </script>
    <script src="{{url('datatables')}}/dataTables.rowsGroup.js"> </script>
    @endif

    @if (in_array("flatpickr", $css_js))
    <script src="{{url('falcon')}}/assets/js/flatpickr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.11/dist/plugins/monthSelect/index.js"></script>
    @endif

    @if (in_array("glightbox", $css_js))
    <!-- GLightbox JS -->
    <script src="{{url('falcon')}}/vendors/glightbox/glightbox.min.js"></script>
    @endif

    @if (in_array("echarts", $css_js))
    <script src="{{url('falcon')}}/vendors/echarts/echarts.min.js"></script>
    <script src="{{url('falcon')}}/assets/js/echarts-example.js"></script>
    {{-- <script src="{{url('falcon')}}/assets/js/echart-example.js"></script> --}}
    @endif

    @if (in_array("world", $css_js))
    <script src="{{url('falcon')}}/assets/data/world.js"></script>
    @endif

    @if (in_array("chart", $css_js))
    <script src="{{url('falcon')}}/vendors/chart/chart.min.js"></script>
    @endif

    @if (in_array("dayjs", $css_js))
    <script src="{{url('falcon')}}/vendors/dayjs/dayjs.min.js"></script>
    @endif

    @if (in_array("countup", $css_js))
    <script src="{{url('falcon')}}/vendors/countup/countUp.umd.js"></script>
    @endif

    @if (in_array("d3", $css_js))
    <script src="{{url('falcon')}}/vendors/d3/d3.min.js"></script>
    @endif

    @if (in_array("fullcalendar", $css_js))
    <script src="{{url('falcon')}}/vendors/fullcalendar/main.min.js"></script>
    @endif

    @if (in_array("leaflet", $css_js))
    <script src="{{url('falcon')}}/vendors/leaflet/leaflet.js"></script>
    <script src="{{url('falcon')}}/vendors/leaflet.markercluster/leaflet.markercluster.js"></script>
    <script src="{{url('falcon')}}/vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js"></script>
    @endif

    @if (in_array("lodash", $css_js))
    <script src="{{url('falcon')}}/vendors/lodash/lodash.min.js"></script>
    @endif

    @if (in_array("validation", $css_js))
    <!-- jquery-validation -->
    <script src="{{url('assets')}}/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{url('assets')}}/jquery-validation/additional-methods.min.js"></script>
    
    <script src="{{url('falcon')}}/vendors/inputmask/inputmask.js"></script>
    <script src="{{url('falcon')}}/vendors/inputmask/bindings/inputmask.binding.js"></script>

    <script>
        if (window.jQuery) {
        var $ = window.jQuery;
        $(document).ready(function () {
            $.fn.inputmask = function(opts) {
                this.each(function() {
                    Inputmask(opts).mask(this);
                });
                return this;
            };
        });
        }
    </script>
    @endif

    @if (in_array("dropzone", $css_js))
        <script type="text/javascript">
            async function customDropZoneImageOne(dataCheck = {}){
                let _id = "";
                var _maxFiles = 1;
                var _maxFilesize = 5;
                if(dataCheck.hasOwnProperty("id")){
                    _id = dataCheck.id;

                    if(dataCheck.hasOwnProperty('maxFiles')){
                        _maxFiles = dataCheck.maxFiles;
                    }

                    if(dataCheck.hasOwnProperty('maxFilesize')){
                        _maxFilesize = dataCheck.maxFilesize;
                    }

                    Dropzone.autoDiscover = false;
                    Dropzone.options.myAwesomeDropzone = false;

                    let _previewTemplate = "";
                    let _showTemplate = null;
                    let _previewsClick = null;
                    let _previewsContainer = "";
                    let _image_or_document = 'image';
                    let _id_image = 'id_image';
                    let _image_or_document_url = "{{route('image.upload')}}";
                    let _image_or_document_url_delete = "{{route('image.delete')}}";
                    let _image_or_document_accepted_files = "image/*";
                    if(dataCheck.hasOwnProperty("previewTemplate")){

                        var previewNode = document.querySelector(`${dataCheck.previewTemplate}`);

                        if(!previewNode){
                            return null;
                        }

                        if(dataCheck.hasOwnProperty("attributeTemplate")){
                            // previewNode.removeAttribute(`${dataCheck.attributeTemplate}`);
                        }

                        if(dataCheck.hasOwnProperty("idTemplate")){
                            previewNode.id = "";
                        }

                        if(dataCheck.hasOwnProperty("previewsClick")){
                            _previewsClick = dataCheck.previewsClick;
                        }

                        if(dataCheck.hasOwnProperty("previewsContainer")){
                            _previewsContainer = dataCheck.previewsContainer;

                            // _previewsContainer = document.querySelector(`${dataCheck.previewsContainer}`).innerHTML;
                        }

                        // var previewTemplate = previewNode.parentNode.innerHTML;
                        // _previewTemplate = previewNode.parentNode.innerHTML;
                        _previewTemplate = previewNode.parentNode.innerHTML;
                        // console.log('_previewTemplate',_previewTemplate);
                        // _previewTemplate = $(previewNode).closest(`${_id}`).find(`${_previewsContainer}`).html();

                        if(dataCheck.hasOwnProperty('showTemplate')){
                            _showTemplate = dataCheck.showTemplate;
                            // previewNode.parentNode.removeChild(previewNode);
                            $(previewNode).closest('div').html(``).addClass('d-none');
                            // $(previewNode).closest(`${_id}`).find(`${_previewsContainer}`).html(``);
                            // $(previewNode).closest(`${_previewsContainer}`).html(``);
                            // $(previewNode).closest(`${_id}`).append(`${dataCheck.showTemplate}`);
                            $(previewNode).closest(`${_id}`).find(`${_previewsContainer}`).append(`${dataCheck.showTemplate}`);

                            // previewNode.parentNode.innerHTML = dataCheck.showTemplate;
                        }else{
                            previewNode.parentNode.removeChild(previewNode);
                        }
                        // $(previewNode).remove();
                    }


                    if(dataCheck.hasOwnProperty('imageOrDocument')){
                        _image_or_document = dataCheck.imageOrDocument;
                    }

                    if(dataCheck.hasOwnProperty('id_image')){
                        _id_image = dataCheck.id_image;
                    }

                    if(_image_or_document == 'files'){
                        _image_or_document_url = "{{route('files.upload')}}";
                        _image_or_document_url_delete = "{{route('files.delete')}}";
                        _image_or_document_accepted_files = ".doc, .docx, .pdf, .xls, .xlsx";
                    }else if(_image_or_document == 'pdf'){
                        _image_or_document_url = "{{route('files.upload')}}";
                        _image_or_document_url_delete = "{{route('files.delete')}}";
                        _image_or_document_accepted_files = ".pdf, application/pdf";
                    }else if(_image_or_document == 'excel'){
                        _image_or_document_url = "{{route('files.upload')}}";
                        _image_or_document_url_delete = "{{route('files.delete')}}";
                        _image_or_document_accepted_files = ".xls, .xlsx";
                    }else if(_image_or_document == 'word'){
                        _image_or_document_url = "{{route('files.upload')}}";
                        _image_or_document_url_delete = "{{route('files.delete')}}";
                        _image_or_document_accepted_files = ".doc, .docx";
                    }

                    let _clickable = "";
                    if(dataCheck.hasOwnProperty("clickable")){
                        _clickable = dataCheck.clickable;
                    }

                    let _show = function _show(sts = true){
                        // console.log('show', sts);
                        if(dataCheck.hasOwnProperty('showTemplate')){
                            if(_previewsClick !== null){
                                if(sts){
                                    // if($(`${_previewsContainer}`).find(`${_previewsClick}`).length > 0){
                                    //     $(`${_previewsContainer}`).append(`${_showTemplate}`);

                                    //     console.log(_showTemplate, sts);
                                    // }
                                    $(`${_id} ${_previewsClick}`).show();
                                }else{
                                    // $(`${_previewsContainer}`).find(`${_previewsClick}`).remove();

                                    $(`${_id} ${_previewsClick}`).hide();
                                }
                                // console.log('showTemplate q', $(`${_previewsContainer} ${_previewsClick}`));
                            }
                        }
                    }

                    // await _show(true);

                    let _removeFile = function _removeFile(file, myThis){
                        if (file.previewElement != null && file.previewElement.parentNode != null) {
                            file.previewElement.parentNode.removeChild(file.previewElement);

                            if(myThis.files.length >= _maxFiles){
                                _show(false);
                            }else{
                                _show(true);
                            }
                        }
                    }

                    var myDropzoneImageCustom = new Dropzone(`${_id}`, {
                        // url: "{{route('image.upload')}}", // Set the url for your upload script location
                        // acceptedFiles: "image/*",
                        url: `${_image_or_document_url}`, // Set the url for your upload script location
                        acceptedFiles: `${_image_or_document_accepted_files}`,
                        paramName: "file", // The name that will be used to transfer the file
                        maxFiles: _maxFiles,
                        timeout: 0,
                        maxFilesize: _maxFilesize, // MB
                        maxThumbnailFilesize: _maxFilesize, // MB
                        // parallelUploads: _maxFiles,
                        // chunking: true,
                        // forceChunking: true,
                        // chunkSize: 1000000 * _maxFilesize,
                        // enqueueForUpload: false,
                        previewTemplate: _previewTemplate,
                        autoQueue: false, // Make sure the files aren't queued until manually added
                        previewsContainer: _previewsContainer, // Define the container to display the preview_images
                        clickable: _clickable, // Define the element that should be used as click trigger to select files.
                        sending: function (file, xhr, formData) {

                            // console.log(file.size/1024 , (1024 * _maxFilesize));

                            formData.append("_token", "{{ csrf_token() }}");
                            if(dataCheck.hasOwnProperty("path_image")){
                                formData.append("path", dataCheck.path_image);
                            }else{
                                formData.append("path", "img/custom");
                            }
                            formData.append("filesize", file.size);
                            formData.append("active", 0);

                        },
                        error: function (file, response){
                            if(response.error){
                                $(file.previewElement).find('[data-dz-errormessage]').html('Error');
                                $(file.previewElement).find('.x-status-upload').html(`<span class="badge rounded-pill bg-danger" style="opacity: .72;"><i class="fas fa-times"></i></span>`);

                                let _width = $(file.previewElement).find(`.position-relative`).css('width');
                                $(file.previewElement).css({'width': _width});
                                if(response.status === "VALIDATION"){
                                    let message_x = '';
                                    let valid_x = response.validation;
                                    Object.keys(valid_x).forEach(function(item, index){
                                        // message_x += `${item} = `;
                                        valid_x[item].forEach(function(i,x){
                                            message_x += `${i}<br>`;
                                        });
                                    });
                                    $(file.previewElement).append(`
                                    <span class="invalid-feedback" style="display:block;">${message_x}</span>
                                    `);
                                }else{
                                    $(file.previewElement).append(`
                                    <span class="invalid-feedback" style="display:block;">${response.message}</span>
                                    `);
                                }
                            }
                        },
                        complete: function(file){
                            // console.log("complete", file);
                        },
                        success: function (file, response){
                            if(!response.error){
                                // console.log('success');
                                if(response.hasOwnProperty('success')){
                                    file.status = Dropzone.SUCCESS;
                                }

                                file.previewElement.id = response.filename_new;
                                if(_id_image == 'id_file'){
                                    file.previewElement.setAttribute('data-id_file', response.id_file);
                                    file.previewElement.setAttribute('data-url', '');
                                }else{
                                    file.previewElement.setAttribute('data-id_image', response.id_image);
                                    file.previewElement.setAttribute('data-url', response.url);
                                }
                                file.previewElement.setAttribute('data-active', response.active);

                                if(dataCheck.hasOwnProperty("input")){
                                    if(_id_image == 'id_file'){
                                        $(file.previewElement).find(`${dataCheck.input}`).val(`${response.id_file}`);
                                    }else{
                                        $(file.previewElement).find(`${dataCheck.input}`).val(`${response.id_image}`);
                                    }
                                    // $(`${_id} ${dataCheck.input}`).val(`${response.id_image}`);
                                }

                                $(file.previewElement).find('.x-status-upload').html(`<span class="badge rounded-pill bg-success" style="opacity: .72;"><i class="fas fa-check"></i></span>`);
                                $(file.previewElement).find('[data-dz-errormessage]').html('');

                                // console.log('sd', response, this.files.length);

                                if(this.files.length >= _maxFiles){
                                    _show(false);
                                }else{
                                    _show(true);
                                }

                                // console.log('success', response, this.files.length, file.name);

                                // var ext = file.name.split('.').pop();

                                // if (ext == "pdf") {
                                //     $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-pdf.png')}}");
                                // } else if (ext.indexOf("doc") != -1) {
                                //     $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msword.png')}}");
                                // }else if (ext.indexOf("docx") != -1) {
                                //     $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msword.png')}}");
                                // } else if (ext.indexOf("xls") != -1) {
                                //     $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msexcel.png')}}");
                                // } else if (ext.indexOf("xlsx") != -1) {
                                //     $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msexcel.png')}}");
                                // }
                            }
                        },
                        init: function() {
                            myThis = this;

                            if(this.files.length >= _maxFiles){
                                _show(false);
                            }else{
                                _show(true);
                            }

                            if(dataCheck.hasOwnProperty('mockAdd')){
                                if(dataCheck.mockAdd !== null){
                                    let _mockFile = {
                                        name: dataCheck.mockAdd.name,
                                        size: dataCheck.mockAdd.size,
                                        status: Dropzone.ADDED,
                                        accepted: true
                                    };

                                    myThis.displayExistingFile(_mockFile, `${dataCheck.mockAdd.url}`,null,null,true);
                                    myThis.files.push(_mockFile);
                                    if(_id_image == 'id_file'){
                                        myThis.emit("success", _mockFile, {
                                            success:  dataCheck.mockAdd.success,
                                            error:  dataCheck.mockAdd.error,
                                            id_file:  dataCheck.mockAdd.id_file,
                                            filename_new:  dataCheck.mockAdd.filename_new,
                                            url:  dataCheck.mockAdd.url,
                                        });
                                    }else{
                                        myThis.emit("success", _mockFile, {
                                            success:  dataCheck.mockAdd.success,
                                            error:  dataCheck.mockAdd.error,
                                            id_image:  dataCheck.mockAdd.id_image,
                                            filename_new:  dataCheck.mockAdd.filename_new,
                                            url:  dataCheck.mockAdd.url,
                                        });
                                    }
                                    myThis.emit("complete", _mockFile);
                                }
                            }
                        },
                        // accept: function(file, done) {
                        //     // file.acceptDimensions = done;
                        //     // file.rejectDimensions = function() {
                        //     //     console.log("Invalid dimension.");

                        //     //     done("Invalid dimension.");
                        //     // };
                        //     // Of course you could also just put the `done` function in the file
                        //     // and call it either with or without error in the `thumbnail` event
                        //     // callback, but I think that this is cleaner.
                        // },
                        maxfilesreached: function(){
                            // console.log("maxfilesreached",this.files.length);
                            if(this.files.length >= _maxFiles){
                                _show(false);
                            }else{
                                _show(true);
                            }
                        },
                        softremovedfile: function(file){
                            myThis = this;

                            _removeFile(file, myThis);

                            return myThis._updateMaxFilesReachedClass;
                            var fileRef = file.previewElement;

                            if(fileRef!=null){
                                fileRef.parentNode.removeChild(file.previewElement);
                                return this._updateMaxFilesReachedClass;
                            }

                            return void 0;


                            return (fileRef = file.previewElement) != null ? fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        },
                        removedfile: function(file){
                            myThis = this;
                            var name = '';
                            var id_image = '';
                            var id_file = '';
                            if(file.previewElement.id != ""){
                                name = file.previewElement.id;

                                id_image = file.previewElement.getAttribute('data-id_image');
                                if(_id_image == 'id_file'){
                                    id_file = file.previewElement.getAttribute('data-id_file');
                                }
                                let _active = file.previewElement.getAttribute('data-active');

                                // _show(false);
                                _removeFile(file, myThis);
                                console.log(_active);
                                if(_active === "true"){
                                    // console.log("nadir");
                                    let _hidden = file.previewElement.getAttribute('data-hidden', 'false');
                                    if(_hidden === "true"){
                                        return myThis._updateMaxFilesReachedClass;
                                    }

                                }

                            }else{
                                _removeFile(file, myThis);
                                return myThis._updateMaxFilesReachedClass;
                            }
                            // console.log(name, id_image, myThis);
                            let _data_send = {
                                    filename: name,
                                    id_image: id_image,
                                    _token: "{{ csrf_token() }}",
                                };
                            if(_id_image == 'id_file'){
                                _data_send = {
                                    filename: name,
                                    id_file: id_file,
                                    _token: "{{ csrf_token() }}",
                                };
                            }

                            var sdt = $.ajax({
                                type: 'POST',
                                url: `${_image_or_document_url_delete}`,
                                // url: "{{route('image.delete')}}",
                                data: _data_send,
                                success: function (data){
                                    // console.log("File has been successfully removed!!");
                                    // return true;
                                },
                                error: function(e) {
                                    // console.log(e);
                                    // return false;
                            }});
                            sdt.done(function(data){
                                // _removeFile(file, myThis);
                                return myThis._updateMaxFilesReachedClass;
                            });

                            sdt.fail(function(data){
                                // _removeFile(file, myThis);
                                return myThis._updateMaxFilesReachedClass;
                            });
                        },
                    });

                    // myDropzoneImageCustom.on("maxfilesexceeded", function(file) { this.removeFile(file); });

                    // myDropzoneImageCustom.on("thumbnail", function(file){
                    //     // console.log(file);

                    //     if ((file.size / 1024) > (1024 * _maxFilesize)) {
                    //         console.log('file besar');
                    //         file.accepted=false;
                    //         this.removeFile(file);

                    //         // file.rejectDimensions();
                    //     }
                    // });

                    myDropzoneImageCustom.on("addedfile", async function(file){
                        // console.log('addedfile');
                        if (this.files.length > _maxFiles) {
                            // console.log('addedfile', myDropzoneImageCustom.files.length);
                            file.accepted=false;
                            this.removeFile(file);
                            return;
                        }else{

                            if ((file.size / 1024) > (1024 * _maxFilesize)) {
                                await $.toast({
                                    heading: 'File Image Size > 5MB, Auto Delete...!',
                                    text: `${file.name}`,
                                    showHideTransition: 'fade',
                                    position: 'top-right',
                                    icon: 'error',
                                    hideAfter: 5000,
                                    stack: 3, // or false to no stack
                                })

                                // console.log(file);
                                // console.log(file.size/1024 , (1024 * _maxFilesize));
                                // console.log('file besar');
                                file.accepted=false;
                                this.removeFile(file);
                                return;

                                // file.rejectDimensions();
                            }

                            // console.log(file.status, file);
                            file.accepted=true;
                            if(this.files.length >= _maxFiles){
                                _show(false);
                            }else{
                                _show(true);
                            }

                            this.enqueueFile(file);
                            this.processQueue();

                            var ext = file.name.split('.').pop();

                            if (ext == "pdf") {
                                $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-pdf.png')}}");
                            } else if (ext.indexOf("doc") != -1) {
                                $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msword.png')}}");
                            }else if (ext.indexOf("docx") != -1) {
                                $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msword.png')}}");
                            } else if (ext.indexOf("xls") != -1) {
                                $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msexcel.png')}}");
                            } else if (ext.indexOf("xlsx") != -1) {
                                $(file.previewElement).find(".dz-image img").attr("src", "{{url('ic-png/my-msexcel.png')}}");
                            }

                            // console.log('addedfile', file.previewElement, file.name);

                            // myDropzoneImageCustom.enqueueFiles(myDropzoneImageCustom.getFilesWithStatus(Dropzone.ADDED))

                            // setTimeout(() => {
                            //     // myDropzoneImageCustom.processQueue();
                            // }, 10);
                            // myDropzoneImageCustom.processFile(file);

                            // myDropzoneImageCustom.emit("complete", file);

                        }
                    });

                    // myDropzoneImageCustom.on("complete", function(file){

                    //     console.log("complete")
                    //     myDropzoneImageCustom.processQueue();
                    // });

                    // myDropzoneImageCustom.on("success", function(file, response){
                    //     if(!response.error){
                    //         if(response.hasOwnProperty('success')){
                    //             file.status = Dropzone.SUCCESS;
                    //         }

                    //         file.previewElement.id = response.filename_new;
                    //         file.previewElement.setAttribute('data-id_image', response.id_image);
                    //         file.previewElement.setAttribute('data-url', response.url);

                    //         if(dataCheck.hasOwnProperty("input")){
                    //             $(file.previewElement).find(`${dataCheck.input}`).val(`${response.id_image}`);
                    //             // $(`${_id} ${dataCheck.input}`).val(`${response.id_image}`);
                    //         }

                    //         $(file.previewElement).find('.x-status-upload').html(`<span class="badge rounded-pill bg-success" style="opacity: .72;"><i class="fas fa-check"></i></span>`);
                    //         $(file.previewElement).find('[data-dz-errormessage]').html('');

                    //         // console.log('sd', response, this.files.length);

                    //         if(this.files.length >= _maxFiles){
                    //             _show(false);
                    //         }else{
                    //             _show(true);
                    //         }
                    //     }
                    // });

                    // myDropzoneImageCustom.on("error", function(file, response){
                    //     console.log(response, file);
                    //     if(response.error){
                    //         $(file.previewElement).find('[data-dz-errormessage]').html('Error');
                    //         $(file.previewElement).find('.x-status-upload').html(`<span class="badge rounded-pill bg-danger" style="opacity: .72;"><i class="fas fa-times"></i></span>`);

                    //         if(response.status === "VALIDATION"){

                    //         }else{

                    //         }
                    //     }
                    // });


                    return myDropzoneImageCustom;
                }

                return null;
            }
        </script>
    @endif

@endpush
{{-- END PUSH script_bottom --}}

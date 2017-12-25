 @extends('backend.index')

 @section('navbar-top-title')
     
     CMS

 @endsection

 @push('navbar-top')

     @include('backend.cms._partials.navbar')

 @endpush

 @section('workbench')  

<div class="container-fluid" style="width: 100%; height: 100%;"> {{-- ace editor needs this --}}
    <div class="row no-gutters" style="width: 100%; height: 100%;"> {{-- ace editor needs this --}}
        <div class="col-12" style="width: 100%; height: 100%;"> {{-- ace editor needs this --}}

            <div class="card" style="width: 100%; height: 100%;"> {{-- ace editor needs this --}}

                <div class="card-header">
                    <div class="tittle d-inline">
                        Ace Editor / Partials / Contact
                    </div>
                    <div class="buttons d-inline pull-right">
                        <button class="btn btn-sm btn-primary">Save</button>
                        <button class="btn btn-sm btn-secondary">Cancel</button>
                        {{-- <a class="mr-2" href="#">Save</a> --}}
                        {{-- <a class="text-dark" href="#">Cancel</a> --}}
                    </div>
                </div>

                <div class="card-body ace-card-body" style="width: 100%; height: 100%;"> {{-- ace editor needs this --}}

                    <div id="aceEditor">
                      
                    </div>

                </div>
                
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.9/ace.js"></script>

    <script>
        var editor = ace.edit('aceEditor');
        editor.setTheme("ace/theme/dawn");
        // editor.setTheme("ace/theme/pastel_on_dark");
        editor.getSession().setMode("ace/mode/html");
        document.getElementById('aceEditor').style.fontSize='18px';
        editor.setOption("displayIndentGuides", false);

        var file = `{!! $file !!}`;

// console.log(file);

        editor.setValue(file, 1);
    </script>

@endpush
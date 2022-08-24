ClassicEditor
    .create( document.querySelector('#descricao'), {
        
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'outdent',
                'indent',
                '|',
                'insertTable',
                'undo',
                'redo'
            ]
        },
        language: 'pt-br',
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:full',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells'
            ]
        },
        licenseKey: '',
        
    } )
    .then( editor => {
        window.editor = editor; 
    } 
    )
    
    .catch( error => {
        console.error( 'Oops, something went wrong!' );
        console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
        console.warn( 'Build id: j33j1odww2yc-ljz663ck9rkq' );
        console.error( error );
    } );
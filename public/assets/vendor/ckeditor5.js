import {
    ClassicEditor,
    AccessibilityHelp,
    Autosave,
    Bold,
    Essentials,
    Italic,
    Mention,
    Paragraph,
    SelectAll,
    Undo,
    Heading, 
    BlockQuote,
    Font, 
    Link, 
    List,
    SimpleUploadAdapter,
} from 'ckeditor5';
import { SlashCommand } from 'ckeditor5-premium-features';

const editorConfig = {
    toolbar: {
        items: ['undo', 'redo', '|', 'selectAll', '|', 'Heading', 'bold', 'italic', 'link', 'numberedList', 'blockQuote', '|', 'accessibilityHelp'],
        shouldNotGroupWhenFull: false
    },
    placeholder: 'Type or paste your content here!',
    plugins: [AccessibilityHelp, Autosave, Bold, Essentials, Italic, Mention, Paragraph, SelectAll, SlashCommand, Undo, Heading, BlockQuote, Font, Link, List, SimpleUploadAdapter ],
    licenseKey: '<TzlDcWJCZkQ4a2RRZW9YbUk3cG5HbFU0U3JBdDF3Tk54dGZqK2t3V0RhekM4QlJYWmZDN2U3Y2RkQmRKY2c9PS1NakF5TkRBNE1qVT0=>',
    mention: {
        feeds: [
            {
                marker: '@',
                feed: [
                    /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
                ]
            }
        ]
    },
    initialData: "<h2></h2>"
};

ClassicEditor
    .create( document.querySelector( '#editor' ), editorConfig )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } 
);

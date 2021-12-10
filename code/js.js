var parent = document.getElementById('component');

function add_element() {
        var newelem = document.createElement('form');
        var title = document.createElement('input');
        var content = document.createElement('input');
        newelem.appendChild(title);
        newelem.appendChild(content);
        parent.appendChild(newelem);
        save_element();

        function save_element(){
            const parsed = parent.innerHTML;
            localStorage.setItem('hiDen', parsed);
        }
    }

function get_element() {
    parent.innerHTML = localStorage.getItem('hiDen');
}

function clear_storage() {
   localStorage.setItem('hiDen', '');
}

window.add = add_element;
window.get_el = get_element;
window.clear_el = clear_storage;
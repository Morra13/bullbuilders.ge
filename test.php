<div class="row align-items-center">
    <div class="col-6 card-profile-pdf-image pl-0">
        <img id="more_img_show_1" src="{{ asset('storage') . '/uploads/defaultUploadImg.png' }}" class="rounded">
    </div>
    <div class="col-6">
        <label for="more_img_1" class="btn btn-creatory">{{ __($obEnum::SELECT_FILE) }}</label>
        <label for="clear" class="btn btn-creatory">{{ __($obEnum::CLEAR) }}</label>
        <input hidden name="clear" id="clear">
    </div>
</div>
<input
        hidden
        name="more_img_1"
        type="file"
        id="more_img_1"
        onchange="document.getElementById('more_img_show_1').src = window.URL.createObjectURL(this.files[0])"
        accept=".jpg,.jpeg,.png"
/>
<div class="row align-items-center">
    <div class="col-6 card-profile-pdf-image pl-0">
        <img id="more_img_show_2" src="{{ asset('storage') . '/uploads/defaultUploadImg.png' }}" class="rounded">
    </div>
    <div class="col-6">
        <label for="more_img_2" class="btn btn-creatory">{{ __($obEnum::SELECT_FILE) }}</label>
        <label for="clear" class="btn btn-creatory">{{ __($obEnum::CLEAR) }}</label>
        <input hidden name="clear" id="clear">
    </div>
</div>
<input
        hidden
        name="more_img_2"
        type="file"
        id="more_img_2"
        onchange="document.getElementById('more_img_show_2').src = window.URL.createObjectURL(this.files[0])"
        accept=".jpg,.jpeg,.png"
/>






<input
    id="inFile"
    name="inFile"
    type="file"
    accept=".jpg,.jpeg,.png"
    multiple
/>
<ul class="preview"></ul>


<script>
    clear_0.addEventListener("click", function(){
        img_0.value = '';
        img_show_0.src = default_img;
        // let newimg_0 = img_0.cloneNode( true )
        // img_0.replaceWith( newimg_0 );
        // img_0 = newimg_0;
    });



    // Сам <input>
    let  input = document.querySelector('#inFile');
    // Блок предпросмотра
    const preview = document.querySelector('.preview');
    // Кнопка отправки файлов
    const button = document.querySelector('button');
    // Список файлов
    const fileList = [];

    // Обработчик кнопки Send
    button.addEventListener('click', ()=>{
        if(!fileList.length){
            alert('Отправлять нечего');
            return;
        }
        //console.log(fileList);

        // Отправлять мы ничего не будем, просто отобразим простой alert()
        alert(JSON.stringify(fileList.map(
            ({name,modified,size}) =>
                ({name,modified,size,data:'<[!FILEDATA]>'})
        ),null,2));
    });

    // Вешаем функцию onChange на событие change у <input>
    input.addEventListener('change', onChange);

    function onChange () {
        // По каждому файлу <input>
        [...input.files].forEach(file=>{
            // Создаём читателя
            const reader = new FileReader;
            // Вешаем событие на читателя
            reader.addEventListener('loadend', ()=>{
                // Элемент списка .preview
                const item = document.createElement('li');
                // Картинка для предпросмотра
                const image = new Image;
                // URI картинки
                image.src = `data:${file.type};base64,${btoa(reader.result)}`;
                // Ссылка на исключение картинки из списка выгрузки
                const remove = document.createElement('a');
                remove.innerHTML = 'X⊗X';
                remove.href="#";
                // Элемент массива fileList
                const fileItem = { name: file.name,
                    modified:file.lastModified,
                    size:file.size,
                    data: reader.result };
                // Добавляем элемент в список выгрузки
                fileList.push(fileItem);
                // Обработчик клика по ссылке исключения картинки
                remove.addEventListener('click',()=>{
                    // Исключаем элемент с картинкой из списка выгрузки
                    fileList.splice(fileList.indexOf(fileItem), 1);
                    // Удаляем элемент списка (<li>) из <ul>
                    item.classList.add('removing');
                    setTimeout(()=>item.remove(),100);
                });
                item.appendChild(remove);
                item.appendChild(image);
                preview.appendChild(item);
            });
            // Запускаем чтение файла
            reader.readAsBinaryString(file);
        });
        // Сбрасываем значение <input>
        input.value = '';
        // Создаем клон <input>
        const newInput = input.cloneNode(true);
        // Заменяем <input> клоном
        input.replaceWith(newInput);
        // Теперь input будет указывать на клона
        input = newInput;
        // Повесим функцию onChange на событие change у нового <input>
        input.addEventListener('change', onChange);
    }
</script>

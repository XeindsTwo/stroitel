export function createImageUploader(maxImages) {
    let imageCount = 0;
    const uploadedImages = document.getElementById("uploadedImages");
    let filesUploaded = false;
    let allSelectedFiles = [];

    function isImageAllowed(file) {
        const allowedTypes = ["image/png", "image/webp", "image/jpeg", "image/jpg"];
        return allowedTypes.includes(file.type);
    }

    function displayError(errorElementId, show = true) {
        const errorElement = document.getElementById(errorElementId);
        if (show) {
            errorElement.classList.add("error--active");
            setTimeout(() => {
                errorElement.classList.remove("error--active");
            }, 5000);
        } else {
            errorElement.classList.remove("error--active");
        }
    }

    function toggleUploadedImagesDisplay() {
        uploadedImages.style.display = imageCount === 0 ? "none" : "grid";
    }

    function addImagePlaceholder(file) {
        console.log("Текущий файл:");
        console.log(file);

        if (imageCount < maxImages) {
            const fileExtension = file.name.split('.').pop();

            if (isImageAllowed(file)) {
                imageCount++;
                const fileURL = URL.createObjectURL(file);
                allSelectedFiles.push({file, url: fileURL});

                updateImagesDisplay();

                displayError("photosLimitMinError", false);
                filesUploaded = true;

                console.log("Реальный массив данных после добавления файла:");
                console.log(allSelectedFiles);
            } else {
                displayError("photosError");
                console.log("Реальный массив данных (файлы не изображения):");
                console.log(allSelectedFiles);
            }
        } else {
            displayError("photosLimitMaxError");
        }
    }

    function updateImagesDisplay() {
        uploadedImages.innerHTML = "";

        allSelectedFiles.forEach((selectedFile, index) => {
            const file = selectedFile.file;
            const fileExtension = file.name.split('.').pop();
            const fileURL = selectedFile.url;

            const imageContainer = document.createElement("div");
            imageContainer.className = "custom-file__item";
            uploadedImages.style.display = "grid";

            const imageInfo = document.createElement("div");
            imageInfo.className = "custom-file__info";

            const removeButton = document.createElement("button");
            removeButton.className = "custom-file__remove";
            removeButton.type = "button";
            removeButton.innerHTML = `
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="path" d="M13 1L1 13" stroke="#a5a5a5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="path" d="M1 1L13 13" stroke="#a5a5a5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `;
            removeButton.addEventListener("click", function () {
                uploadedImages.removeChild(imageContainer);
                imageCount--;

                const indexToRemove = allSelectedFiles.indexOf(selectedFile);
                if (indexToRemove !== -1) {
                    allSelectedFiles.splice(indexToRemove, 1);
                }

                updateImagesDisplay();

                displayError("photosLimitMinError", false);
                filesUploaded = allSelectedFiles.length > 0;
                console.log("Реальный массив данных после удаления файла:");
                console.log(allSelectedFiles);
            });

            imageInfo.appendChild(removeButton);
            imageContainer.appendChild(imageInfo);

            const imagePreview = document.createElement("img");
            imagePreview.className = "custom-file__preview";
            imagePreview.src = fileURL;
            imagePreview.alt = file.name;
            imagePreview.height = 400;
            imageContainer.appendChild(imagePreview);

            const imageNumber = document.createElement("span");
            imageNumber.textContent = `Картинка ${index + 1}.${fileExtension}`;
            imageInfo.appendChild(imageNumber);

            uploadedImages.appendChild(imageContainer);
        });

        toggleUploadedImagesDisplay();

        const formData = new FormData();
        allSelectedFiles.forEach((selectedFile, index) => {
            formData.append(`photos[${index}]`, selectedFile.file);
        });

        console.log('Файлы для отправки на сервер:');
        for (let pair of formData.entries()) {
            console.log(pair[0], pair[1]);
        }
    }

    function updateImageNumbers() {
        const imageContainers = uploadedImages.querySelectorAll(".custom-file__item");

        imageContainers.forEach((container, index) => {
            const imageNumber = container.querySelector("span");
            const currentText = imageNumber.textContent;
            const fileExtension = currentText.split('.').pop();
            imageNumber.textContent = `Картинка ${index + 1}.${fileExtension}`;
        });
        console.log(`Количество изображений: ${allSelectedFiles.length}`);
    }

    document.getElementById("fileInput").addEventListener("change", function () {
        const files = this.files;
        for (const file of files) {
            addImagePlaceholder(file);
        }
    });

    document.getElementById("submitButton").addEventListener("click", function () {
        if (!filesUploaded) {
            displayError("photosLimitMinError");
            return;
        }

        console.log("Следующие файлы будут отправлены на сервер:");
        allSelectedFiles.forEach((file, index) => {
            console.log(`Файл ${index + 1}: ${file.file.name}`);
        });

        console.log(`Всего файлов: ${allSelectedFiles.length}`);
    });

    document.querySelector(".admin-add__form").addEventListener("submit", function (event) {
        if (imageCount < 1) {
            displayError("photosLimitMinError");
            event.preventDefault();
        }
    });
}
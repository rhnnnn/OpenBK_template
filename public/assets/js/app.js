$(document).ready(() => {

    // document.getElementById('#filter-kelas').addEventListener('change',()=>{
    //     const url=new URL(window.location.href)
    //     url.searchParams.set('filter-kelas',this.value)
    //     url.searchParams.delete('page')
    //     window.location.href=url.toString()
    // })
    
    // function changePaginationLength(length){
    //     const url=new URL(window.location.href)
    //     url.searchParams.set('length',length)
    //     window.location.href=url.toString()
    // }

    // $(document).ready(()=>{
    //     $('.custom-select').change(()=>{
    //         let length=$(this).val()
    //         changePaginationLength(length)
    //     })
    // })

    // live search function
    $(document).ready(async () => {
        $("#search").on("keyup", function () {
            let value = $(this).val().toLowerCase();
            let url = new URL(window.location.href);
            url.searchParams.set("search", value);
            url.searchParams.delete("page");
            let newUrl = url.toString();

            $.ajax({
                url: newUrl,
                success: function (result) {
                    // replace the table body with the new HTML returned from the server
                    $("#table-body").html($(result).find("#table-body").html());
                    // Update pagination links to match the filtered rows
                    $(".pagination a").each(function () {
                        let href = $(this).attr("href");
                        href = href.split("?")[0] + "?" + url.searchParams.toString();
                        $(this).attr("href", href);
                    });
                },
            });
        });
    });
});

// image preview upload
function previewImage() {
    const fileInput = document.getElementById("file-input");
    const imagePreview = document.getElementById("image-preview");

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.src = "";
        imagePreview.style.display = "none";
    }
}

// image preview edit
document.addEventListener("DOMContentLoaded", function () {
    const fotoURLs = document.querySelectorAll("div[data-foto-url]");

    fotoURLs.forEach(function (cardBody) {
        const photoURL = cardBody.getAttribute("data-foto-url");
        const identifier = cardBody.querySelector("img").id.split("-")[3];
        const imagePreview = document.getElementById("image-preview-edit-" + identifier);

        // console.log(identifier)

        if (photoURL) {
            imagePreview.src = photoURL;
        } else {
            imagePreview.src = "../assets/img/default/OIP.jpeg"; // Use your default image path
        }
    });
});

function previewImageEdit(identifier) {
    const fileInputEdit = document.getElementById("file-input-edit-" + identifier);
    const imagePreviewEdit = document.getElementById("image-preview-edit-" + identifier);

    if (fileInputEdit.files && fileInputEdit.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreviewEdit.src = e.target.result;
            imagePreviewEdit.style.display = "block";
        };

        reader.readAsDataURL(fileInputEdit.files[0]);
    } else {
        // If no file is selected, set the image to the database photo
        const fotoURL = document.getElementById("up-preview-image-" + identifier).getAttribute("data-foto-url");
        imagePreviewEdit.src = fotoURL;
        imagePreviewEdit.style.display = "block";
    }
}

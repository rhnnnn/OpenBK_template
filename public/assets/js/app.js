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

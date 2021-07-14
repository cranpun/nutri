const U = {};
U.setConfirmDelete = function () {
    const btns = document.querySelectorAll(".act-del");
    btns.forEach(function (btn) {
        btn.addEventListener("click", function (ev) {
            Swal.fire({
                title: "確認",
                text: "本当に削除しますか？",
                icon: "warning",
                showCancelButton: true,
            }).then(function (res) {
                if (res.isConfirmed) {
                    const formid = ev.target.getAttribute("data-delform-cssid");
                    const form = document.querySelector(formid);
                    form.submit();
                }
            });
        });
    });
}

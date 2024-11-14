document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("image");
    const submitButton = document.getElementById("submit-button");

    submitButton.style.display = "none";

    imageInput.addEventListener("change", function () {
        // 画像が選択されているかどうかを確認し、ボタンの状態を変更
        if (imageInput.files && imageInput.files.length > 0) {
            submitButton.style.display = "block";
        } else {
            submitButton.style.display = "none";
        }
    });
});

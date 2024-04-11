function validateForm() {
    // 名前の入力値を取得
    let name = document.getElementById("name").value;
    // メールアドレスの入力値を取得
    let email = document.getElementById("email").value;
    // お問い合わせ内容の入力値を取得
    let message = document.getElementById("message").value;

    // 名前が入力されているか確認
    if (name === "") {
        alert("名前を入力してください");
        return false;
    }
    // メールアドレスの正規表現パターン
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    // メールアドレスが正規化されているか確認
    if (!emailPattern.test(email)) {
        alert("正しいメールアドレスを入力してください");
        return false;
    }
    // お問い合わせ内容が入力されているか確認
    if (message === "") {
        alert("お問い合わせ内容を入力してください");
        return false;
    }
    return true;
}
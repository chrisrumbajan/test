function toast_fail(title, body, delay=2000) {
    $(document).Toasts("create", {
        class: "bg-danger",
        title: title,
        autohide: true,
        delay: delay,
        fixed: false,
        body: body
    });
}
$("#myModal").on("shown.bs.modal", function () {
  $("#myInput").trigger("focus");
});



let modal = document.querySelector("#loginModal");
let forgot = document.querySelector("#linkForgot");
let recover = document.querySelector("#btnRecover");

$(function() {
  $('#forgotModal').on('shown.bs.modal', function () {
    modal.style.display = "none";
  })
})

if (recover) {
  recover.addEventListener("click", function () {
    modal.style.display = "inherit";
  });
}

var nb_element = 0;
var el = document.getElementById("s0");
while (el != null) {
  nb_element++;
  el = document.getElementById("s" + nb_element.toString());
}

let valeurs = [];
let stocks = [];

for (let i = 0; i < nb_element; i++) {
  valeurs.push(0);
  stocks.push(Number(document.getElementById("s" + i.toString()).innerHTML));
}

function hide() {
  document.getElementById("ss").hidden = !document.getElementById("ss").hidden;
  if (document.getElementById("ss").hidden) {
    document.getElementById("btns").innerHTML = "Afficher stock";
  } else {
    document.getElementById("btns").innerHTML = "Cacher stock";
  }
  for (let i = 0; i < stocks.length; i++) {
    document.getElementById("s" + i.toString()).hidden =
      !document.getElementById("s" + i.toString()).hidden;
  }
}

function incrementer(i) {
  if (valeurs[i] + 1 <= stocks[i]) {
    valeurs[i]++;
    document.getElementById(i.toString()).innerHTML = valeurs[i].toString();
    document.getElementById("-" + i.toString()).removeAttribute("disabled");
  }
  if (valeurs[i] == stocks[i]) {
    document
      .getElementById("+" + i.toString())
      .setAttribute("disabled", "true");
  }
}

function decrementer(i) {
  if (valeurs[i] - 1 >= 0) {
    valeurs[i]--;
    document.getElementById(i.toString()).innerHTML = valeurs[i].toString(); // on récupère l'element d'id i et on accede aux donnnes html avec innerHTML
    document.getElementById("+" + i.toString()).removeAttribute("disabled");
  }
  if (valeurs[i] == 0) {
    document
      .getElementById("-" + i.toString())
      .setAttribute("disabled", "true");
  }
}

$(document).ready(function () {
  $(".button-panier").click(function () {
    var quantite = $(this).closest("td").find("span").text();
    var reference = $(this).closest("td").find("span").data("ref");
    var image = $(this).closest("td").find("span").data("img");
    var prix = $(this).closest("td").find("span").data("prix");
    var stock = $(this).closest("td").find("span").data("stock");
    if (quantite > 0) {
      let dataTMP = {
        'quantite': quantite,
        'ref': reference,
        'image': image,
        'prix': prix,
        'stock': stock,
      };
      $.ajax({
        type: "GET",
        url: "traitement.php",
        data: dataTMP,
        success: function (response) {
          $(".button-panier").closest("td").find("span").text('0');
          console.log("Réponse du serveur : ", response);
          window.location.href = "index.php?page=panier";

        },
        error: function (xhr, status, error) {
          console.error("Erreur lors de l'envoi de la valeur à PHP");
          console.error(xhr, status, error);
          console.log(dataTMP);
        },
      });
    }
  });
});


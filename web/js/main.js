$(document).ready(function () {
    $.getJSON("index.php?r=news/latest", function (data) {
        let html = "";
        data.articles.forEach(function (article) {
            html += `
                <div class="card mb-3 shadow-sm">
                    ${article.urlToImage ? `<img src="${article.urlToImage}" class="card-img-top" alt="">` : ""}
                    <div class="card-body">
                        <h5 class="card-title">${article.title}</h5>
                        <p class="card-text">${article.description || ""}</p>
                        <a href="${article.url}" target="_blank" class="btn btn-primary">Ler mais</a>
                    </div>
                </div>
            `;
        });
        $("#news-container").html(html);
    });
});

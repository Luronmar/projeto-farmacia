/*var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    freeMode: true,
    autoplay: {
        delay: 3000,
    },
    loop: true,
    breakpoints: {
        600: {
            slidesPerView: 2,
            spaceBetween: 30,
        }
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    }
});*/
fetch('backend.json')
    .then(response=>response.json())
    .then(data=>{
        localStorage.setItem('produtos',JSON.stringify(data));
        $("#produtos").empty();
        data.forEach(produto=>{
            var ProdutoHtml = `
            <div class="item-card">
<a data-id="${produto.id}" href="#" class="item">
<div class="img-container">
<img src="${produto.imagem}">
</div>
<div class="nome-rating">
<span class="color-gray">Nome do Item</span>
<span class="bold margin-right">
<i class="mdi mdi-star"></i>
${produto.rating}
</span>
</div>
<div class="price">${produto.preco.toLocaleString('pt-BR', {style:'currency', currency:'BRL'})}</div>
</a>
</div>
            
            `;
            $("#produtos").append.ProdutoHtml;
        }
    )

    })
    .catch(error=>console.error('Erro ao mostrar dados'+error));
    



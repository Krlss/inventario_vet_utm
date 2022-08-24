$('.sort').click((event)=>{
    document.getElementById('loading_gif').style.display = ''
});
function showLoading(event) {
    document.getElementById('loading_gif').style.display = ''
}
function hiddenLoading() {
    document.getElementById('loading_gif').style.display = 'none'
}

$('.close-loading').click((event)=>{
    document.getElementById('loading_gif').style.display = 'none'
})

$('.page-link').click((event)=>{
    document.getElementById('loading_gif').style.display = ''
});
<script>// search car
    var selectedBrandId = null;
    var selectedModelId = null;

    function filterBrands() {
        var input = document.getElementById('search-input').value.toLowerCase();
        var brandList = document.getElementById('brand-list');
        var buttons = brandList.getElementsByClassName('list-mycarsearch');

        for (var i = 0; i < buttons.length; i++) {
            var brandTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            if (brandTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }

    function filterModels() {
        var input = document.getElementById('model-search-input').value.toLowerCase();
        var modelList = document.getElementById('model-list');
        var buttons = modelList.getElementsByClassName('list-mycarsearch');

        for (var i = 0; i < buttons.length; i++) {
            var modelTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            if (modelTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }

    document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(button) {
        button.addEventListener('click', function() {
            selectedBrandId = this.getAttribute('data-brand-id');
            var modelList = document.getElementById('model-list');
            modelList.innerHTML = '';

            document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(btn) {
                btn.classList.remove('active');
            });
            this.classList.add('active');

            var brandData = @json($brandData);
            if (brandData[selectedBrandId]) {
                var models = brandData[selectedBrandId].models;
                for (var modelId in models) {
                    if (models.hasOwnProperty(modelId)) {
                        var model = models[modelId];
                        var modelButton = document.createElement('button');
                        modelButton.className = 'list-mycarsearch';
                        modelButton.setAttribute('data-model-id', modelId);
                        modelButton.innerHTML = '<div>' + model.modelname + '</div><div class="num-mycarsearch">(' + model.car_count_model + ')</div>';
                        modelButton.addEventListener('click', function() {
                            selectedModelId = this.getAttribute('data-model-id');
                            document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(btn) {
                                btn.classList.remove('active');
                            });
                            this.classList.add('active');
                            window.location.href = `{{ route('specialadddealPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
                        });
                        modelList.appendChild(modelButton);
                    }
                }
            }
        });
    });

    document.getElementById('search-button').addEventListener('click', function() {
        var keyword = document.getElementById('car-id-input').value;
        var url = new URL(window.location.href);

        url.searchParams.delete('brand_id');
        url.searchParams.delete('model_id');
        url.searchParams.set('keyword', keyword);

        window.location.href = url.toString();
    });

    document.getElementById('reset-button').addEventListener('click', function() {
        var url = new URL(window.location.href);
        url.search = '';
        window.location.href = url.toString();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var brandId = urlParams.get('brand_id');
        var modelId = urlParams.get('model_id');

        if (brandId) {
            document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(button) {
                if (button.getAttribute('data-brand-id') === brandId) {
                    button.classList.add('active');
                    selectedBrandId = brandId;

                    var brandData = @json($brandData);
                    if (brandData[selectedBrandId]) {
                        var models = brandData[selectedBrandId].models;
                        var modelList = document.getElementById('model-list');
                        modelList.innerHTML = '';

                        for (var modelId in models) {
                            if (models.hasOwnProperty(modelId)) {
                                var model = models[modelId];
                                var modelButton = document.createElement('button');
                                modelButton.className = 'list-mycarsearch';
                                modelButton.setAttribute('data-model-id', modelId);
                                modelButton.innerHTML = '<div>' + model.modelname + '</div><div class="num-mycarsearch">(' + model.car_count_model + ')</div>';
                                modelButton.addEventListener('click', function() {
                                    selectedModelId = this.getAttribute('data-model-id');
                                    document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(btn) {
                                        btn.classList.remove('active');
                                    });
                                    this.classList.add('active');
                                    window.location.href = `{{ route('specialadddealPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
                                });
                                modelList.appendChild(modelButton);
                            }
                        }

                        if (modelId) {
                            document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(button) {
                                if (button.getAttribute('data-model-id') === modelId) {
                                    button.classList.add('active');
                                    selectedModelId = modelId;
                                }
                            });
                        }
                    }
                }
            });
        }
    });
</script>
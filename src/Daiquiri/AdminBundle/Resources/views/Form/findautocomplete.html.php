
<?php $view['slots']->start('findautocomplete_widget') ?>
<div class="input-group">
    <?php
    //dump($view['form']->vars->entities);
    ?>

    <div class="typeahead__container ">
        <div class="typeahead__field">

            <span class="typeahead__query">
                
                <input class="aqui"
                       name="q"
                       type="search"
                       autocomplete="off">
                
            </span>


        </div>
    </div>
    <script>
        route_hotel = "<?php echo $view['router']->path('daiquiri_admin_autocomplete_get_hotel') ?>";
        $.typeahead({
            input: '.aqui',
            minLength: 1,
            order: "asc",
            dynamic: true,
            delay: 500,
            backdrop: {
                "background-color": "#fff"
            },
            emptyTemplate: "no result for ",
            dropdownFilter: "all beers",
            emptyTemplate: 'No result for "{{query}}"',
                    source: {
                        "ale": {
                            ajax: {
                                url: route_hotel,
                                path: "data.beer.ale"
                            }
                        },
                        "lager": {
                            ajax: {
                                url: route_hotel,
                                path: "data.beer.lager"
                            }
                        },
                        "stout and porter": {
                            ajax: {
                                url: route_hotel,
                                path: "data.beer.stout"
                            }
                        },
                        "malt": {
                            ajax: {
                                url: route_hotel,
                                path: "data.beer.malt"
                            }
                        }
                    },
            callback: {
                onClickAfter: function (node, a, item, event) {

                    event.preventDefault;

                    // href key gets added inside item from options.href configuration
                    alert(item.href);

                }
            },
            debug: true
        });
    </script>    

</div>
<?php $view['slots']->stop() ?>
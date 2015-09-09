<div id={{ $contentDivId }}>
    {{ HTML::image('images/ajax-loader.gif', 'loader', array('class'=>'googleSearchLoader')) }}
    <table class="google-image-search-table" hidden>
    </table>
</div>
<div id="branding"  style="float: left;"></div><br />
<input id={{ $imageUrlInput }} name={{ $imageUrlInput }} hidden>

<script type="text/javascript">
    var contentDivId;
    var googleImageSearchTable;
    var loader;
    var imageUrlInput;

    function executeGoogleSearch(searchString, contentDiv, imageUrl) {
        contentDivId = contentDiv;
        imageUrlInput = imageUrl;

        loader = $('#' + contentDivId + ' > :nth-child(1)');
        googleImageSearchTable = $('#' + contentDivId + ' > :nth-child(2)');

        googleImageSearchTable.hide();
        loader.show();

        //imageSearch.execute(searchString);

        var cx = {{ Config::get("GIS::googleImageCx") }};
        var key = {{ Config::get("GIS::googleImageKey") }};
        $.get('https://www.googleapis.com/customsearch/v1?cx=' + cx + '&key=' + key + '&searchType=image&imgSize=medium&alt=json&q=' + searchString, function (data) {
            results = data.items;

            if (results && results.length > 0) {


                googleImageSearchTable.empty();

                var tableBody = $('<tbody></tbody>');
                var tableRow = $('<tr></tr>');
                googleImageSearchTable.append(tableBody);
                tableBody.append(tableRow);
                for (var i = 0; i < results.length; i++) {
                    if (i == 5) {
                        var tableRow = $('<tr></tr>');
                        tableBody.append(tableRow);
                    }
                    // For each result write it's title and image to the screen
                    var result = results[i];
                    var tableData = $("<td></td>");

                    var newImg = $('<img width="150px">');
                    newImg.attr('src', result.image.thumbnailLink);
                    newImg.attr('imageUrl', result.link);
                    if (result.url === $('#' + imageUrlInput).val()) {
                        newImg.addClass("google-selected-image");
                        newImg.addClass(contentDivId);
                    }

                    tableData.append(newImg);

                    tableRow.append(tableData);

                    newImg.on('click', function () {
                        $('.' + contentDivId).removeClass("google-selected-image");
                        $('.' + contentDivId).removeClass(contentDivId);
                        $(this).addClass("google-selected-image");
                        $(this).addClass(contentDivId);
                        $('#' + imageUrlInput).val($(this).attr('imageUrl'));
                    });
                }
                loader.hide();
                googleImageSearchTable.show();
            }
        }).fail(function() {
            alert( "error" );
        });
    }
</script>
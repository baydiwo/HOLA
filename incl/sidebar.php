<div class="col-md-3">
    <div id="qz-connection" class="panel panel-default">
        <div class="panel-heading">
            <button class="close tip" data-toggle="tooltip" title="Launch QZ" id="launch" href="#" onclick="launchQZ();" style="display: none;">
                <i class="fa fa-external-link"></i>
            </button>
            <h3 class="panel-title">
                Connection: <span id="qz-status" class="text-muted" style="font-weight: bold;">Unknown</span>
            </h3>
        </div>

        <div class="panel-body">
            <div class="btn-toolbar">
                <div class="btn-group group-connect" role="group">
                    <button type="button" class="btn btn-default btn-connect" onclick="startConnection();">Connect</button>
                    <button type="button" class="btn btn-default btn-connect" onclick="endConnection();">Disconnect</button>
                </div>
                <div class="btn-group group-connect" role="group">
                    <button type="button" class="btn btn-default btn-list" onclick="listNetworkInfo();">List Network Info</button>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Printer</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <input type="text" id="printerSearch" value="" class="form-control" placeholder="Search Printer" />
            </div>
            <div class="btn-toolbar">
                <div class="btn-group group-connect" role="group">
                    <button type="button" class="btn btn-default btn-list" onclick="findPrinter($('#printerSearch').val(), true);">Find Printer</button>
                    <button type="button" class="btn btn-default btn-list" onclick="findDefaultPrinter(true);">Find Default Printer</button>
                    <button type="button" class="btn btn-default btn-list" onclick="findPrinters();">Find All Printers</button>
                </div>
            </div>


            <hr />
            <div class="form-group">
                <label>Current printer:</label>
                <div id="configPrinter">NONE</div>
            </div>
            <!-- <div class="form-group">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-sm" onclick="setPrinter($('#printerSearch').val());">Set To Search</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#askFileModal">Set To File</button>
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#askHostModal">Set To Host</button>
                </div>
            </div> -->
        </div>


    </div>
</div>

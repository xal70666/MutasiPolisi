<script type="text/javascript" src="plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: ''
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>Pengaduan ' + this.series.name + '</b><br/>' +
                        'Ada ' + this.point.y + ' Aduan';
                }
            }
        });
    });
</script>

<div class="box box-success">
    <div class="box-header">
    <i class="fa fa-th-list"></i>
    <h3 class="box-title">Grafik Pengaduan Per-Wilayah</h3>
        <div class="box-tools pull-right">
           <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
        </div>

<div class="box-body chat" id="chat-box">
    <script src="plugins/highchart/highcharts.js"></script>
    <script src="plugins/highchart/modules/data.js"></script>
    <script src="plugins/highchart/modules/exporting.js"></script>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style='display:none'>
    <thead>
        <tr>
            <th></th>
            <th>Wilayah 1</th>
            <th>Wilayah 2</th>
            <th>Wilayah 3</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $grafik = mysql_query("SELECT * FROM er_pengaduan");
        while ($r = mysql_fetch_array($grafik)){
            $tanggal = substr($r[tgl_mulai1], 0,10);
            $ale = tgl_grafik($tanggal);
            $w1 = mysql_num_rows(mysql_query("SELECT * FROM er_pengaduan where er_wilayah='1' AND tgl_mulai1='$r[tgl_mulai1]'"));
            $w2 = mysql_num_rows(mysql_query("SELECT * FROM er_pengaduan where er_wilayah='2' AND tgl_mulai1='$r[tgl_mulai1]'"));
            $w3 = mysql_num_rows(mysql_query("SELECT * FROM er_pengaduan where er_wilayah='3' AND tgl_mulai1='$r[tgl_mulai1]'"));
            echo "<tr>
                    <th>$ale</th>
                    <td>$w1</td>
                    <td>$w2</td>
                    <td>$w3</td>
                  </tr>";
        }
    ?>
    </tbody>
</table>
</div><!-- /.chat -->
</div><!-- /.box (chat box) -->


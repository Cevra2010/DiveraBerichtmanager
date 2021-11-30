<html>
<style>
    table.table {
        border: 3px solid #000000;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }
    table.table td, table.table th {

        border: 1px solid #000000;
        padding: 2px
    }
    table.table tbody td {
        font-size: 11px;
    }
    table.table thead {
        background: #CFCFCF;
        background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        border-bottom: 0px solid #000000;
    }
    table.table thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
        text-align: left;
        border-left: 0px solid #D0E4F5;
    }
    table.table thead th:first-child {
        border-left: none;
    }

    table.table tfoot td {
        font-size: 14px;
    }
</style>

<table class="table">
    <thead>
    <tr>
        <th style="width: 100px;">Nachname</th>
        <th  style="width: 100px;">Vorname</th>
        <td></td>
    </tr>
    </thead>
    <tbody>
    @foreach($personal as $person)
        <tr>
            <td>{{ $person->lastname }}</td>
            <td>{{ $person->firstname }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>
</html>

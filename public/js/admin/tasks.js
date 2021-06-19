'use strict';

$(document).ready(function () {
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $(document).on('change', '#wallet_id', function () {
        let hostsSelect = $('#host_id');
        hostsSelect.find('option').remove();

        let wallet_id = $(this).val();
        let request = $.ajax({
            url: "/admin/hosts/index.json",
            data: {wallet_id: wallet_id},
            method: "GET",
            dataType: "json"
        });

        request.done(function (data) {
            data.hosts.forEach(function (item) {
                hostsSelect.append(`<option value="${item.id}">${item.name} (${item.type})</option>`);
            });
            hostsSelect.trigger('change');
        });
    });

    $(document).on('change', '#host_id', function () {
        let storagesSelect = $('#storage_id');
        storagesSelect.find('option').remove();

        let host_id = $(this).val();
        let request = $.ajax({
            url: "/admin/storages/index.json",
            data: {host_id: host_id},
            method: "GET",
            dataType: "json"
        });

        request.done(function (data) {
            data.storages.forEach(function (item) {
                storagesSelect.append(`<option value="${item.id}">${item.path} (${item.free_size})</option>`);
            });
        });
    });

    // $(document).on('show.bs.collapse', 'tr', function () {
    //     let [pad, wallet_id, storage_id] = this.id.split('-');
    //
    //     let placeholderTr = $(this);
    //     placeholderTr.find('td').remove();
    //     placeholderTr.append('<td colspan="6">Loading ...</td>');
    //
    //     let request = $.ajax({
    //         url: "/admin/tasks/index.json",
    //         data: {wallet_id, storage_id},
    //         method: "GET",
    //         dataType: "json"
    //     });
    //     request.done(function (data) {
    //         let table = $("<table class='table table-sm table-nowrap card-table table-hover'><thead><tr>\n" +
    //             "                        <th class=\"pl-0\">Status</th>\n" +
    //             "                        <th class=\"pl-0\">Issued at</th>\n" +
    //             "                        <th class=\"pl-0\">Host name</th>\n" +
    //             "                        <th class=\"pl-0\">Phase progress</th>\n" +
    //             "                        <th class=\"pl-0\"></th>\n" +
    //             "                    </tr></thead><tbody></tbody></table>");
    //         placeholderTr.find('td').html('').css({'padding': '0'});
    //         placeholderTr.find('td').append(table);
    //         let tbody = table.find('tbody');
    //
    //         data.data.forEach(function (item) {
    //             item.is_closed = item.is_closed === 0 ? 'Opened' : 'Closed';
    //             item.issued_at = item.issued_at === null ? '' : item.issued_at;
    //             item.host_name = item.host_name === null ? '' : item.host_name;
    //             item.phase_status_id = item.phase_status_id === null ? '' : item.phase_status_id;
    //             if (item.is_closed === 'Closed') {
    //                 tbody.append(`<tr>
    //                             <td class="pl-0">${item.is_closed}</td>
    //                             <td class="pl-0">${item.issued_at}</td>
    //                             <td class="pl-0">${item.host_name}</td>
    //                             <td class="pl-0">${item.phase_status_id}/4</td>
    //                             <td class="pl-0"></td>
    //                         </tr>`);
    //
    //             } else {
    //                 tbody.append(`<tr>
    //                             <td class="pl-0">${item.is_closed}</td>
    //                             <td class="pl-0">${item.issued_at}</td>
    //                             <td class="pl-0">${item.host_name}</td>
    //                             <td class="pl-0">${item.phase_status_id}/4</td>
    //                             <td class="pl-0">
    //                                 <a class="ml-1 btn btn-sm btn-outline-danger delete-task-btn" rel="nofollow" href="#" data-task-id="${item.id}">
    //                                     <i class="fe fe-trash"></i> Delete task
    //                                 </a>
    //                             </td>
    //                         </tr>`);
    //             }
    //         });
    //
    //         $('.delete-task-btn').click(deleteTaskHandler);
    //     });
    // });

    // function deleteTaskHandler(event) {
    //     event.preventDefault();
    //     if (!confirm('Delete task ?')) {
    //         return;
    //     }
    //
    //     let self = $(this);
    //     let taskId = self.data('task-id');
    //     $.ajax({
    //         url: "/admin/tasks/delete/" + taskId,
    //         method: "POST",
    //         success: function () {
    //             self.closest('tr').remove();
    //         }
    //     });
    // }

    // $('.btn-delete-tasks').click(function (event) {
    //     event.preventDefault();
    //
    //     if (!confirm('Delete all opened tasks ?')) {
    //         return;
    //     }
    //
    //     let self = $(this);
    //     let [pad, wallet_id, storage_id, queue_id] = self.data('target').split('-');
    //
    //     $.ajax({
    //         url: "/admin/tasks/delete",
    //         method: "POST",
    //         data: { wallet_id, storage_id, queue_id },
    //         success: function () {
    //             window.location.reload();
    //         }
    //     });
    // });

    setTimeout(() => window.location.reload(), 1000 * 60);
});

import api from '@common/api'
const hrmService = {
    leave: {
        all: (data) => api.get('extension/hrm/leave', {
            params: data
        }),
        add: (data) => api.post('extension/hrm/leave', data),
        update: (data) => api.put('extension/hrm/leave/' + data.id, data)
    },
    attendance: {
        all: (data) => api.get('extension/hrm/attendance', {
            params: data
        }),
        add: (data) => api.post('extension/hrm/attendance', data),
        update: (data) => api.put('extension/hrm/attendance/' + data.id, data)
    },
    report: {
        all: (data) => api.get('extension/hrm/report', {
            params: data
        }),
        add: (data) => api.post('extension/hrm/report', data)
    },
    export: {
        all: (data) => api.get('extension/hrm/export', {
            params: data
        }),
        show: (data) => api.get('extension/hrm/export/' + data.id, {
            params: data
        })
    }
}
export default hrmService;
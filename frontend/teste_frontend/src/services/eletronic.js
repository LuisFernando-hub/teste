import http from '@/services/config';

export default {
    getEletronic: () => {
        return http.get('/eletronic')
    },

    createEletronic: (eletronic) => {
        return http.post('/eletronic', eletronic)
    },

    updateEletronic: (eletronic) => {
        return http.put(`/eletronic/${eletronic.id}`, eletronic)
    },

    deleteEletronic: (eletronic) => {
        return http.delete(`/eletronic/${eletronic.id}`, { data: eletronic })
    }
}


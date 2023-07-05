import http from '@/services/config';

export default {
    getEletronic: () => {
        return http.get('/eletronic')
    },

    createEletronic: (eletronic) => {
        return http.post('/eletronic', eletronic)
    }
}


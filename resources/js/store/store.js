import actions from './actions';
import getters from './getters';
import mutations from './mutations';

export default {
    state: {
        page_loader: false,
        loading: false,
        errors: [],
        calls: [],
    },
    getters,
    mutations,
    actions
}

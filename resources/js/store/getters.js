export default {

    page_loader(state) {
        return state.page_loader
    },

    loading(state) {
        return state.loading;
    },
    errors(state) {
        return state.errors;
    },
    alertEvent(state) {
        eventBus.$emit('alertEvent', state)
        // return state.alertEvent;
    },
    

}

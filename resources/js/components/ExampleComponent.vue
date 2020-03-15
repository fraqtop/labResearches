<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Привет, я посчитаю ориентировочную дату выдачи результатов</div>
                    <div class="card-body centered">
                        <select class="form-control" v-model="selectedResearch">
                            <option :value="null" disabled>Не выбрано</option>
                            <option
                                    v-for="research in notChosenResearches"
                                    v-bind:key="research.id"
                                    :value="research"
                            >
                                {{research.title}}
                            </option>
                        </select>
                        <input
                                :disabled="selectedResearch === null"
                                @click="addResearch"
                                type="button"
                                value="добавить"
                                class="btn btn-dark ml-2"
                        />
                    </div>
                </div>
            </div>
            <div class="chosen-list col-md-4">
                <div class="chosen-element" v-for="chosenResearch in chosenResearches">
                    {{chosenResearch.title}}
                    <span @click="dropResearch(chosenResearch)" class="dropper font-weight-bold">X</span>
                </div>
            </div>
        </div>
        <div class="jumbotron mt-3">
            <h3>Планируемая дата выдачи {{testDate}}</h3>
        </div>
        <form @submit.prevent="saveResearch">
            <div class="row">
                <div class="col">
                    <input
                            v-model="newResearch.title"
                            type="text"
                            placeholder="Название исследования"
                            class="form-control"
                            required
                    />
                </div>
                <div class="col">
                    <input
                            v-model="newResearch.days"
                            type="number"
                            placeholder="Количество дней"
                            class="form-control"
                            required
                    />
                </div>
                <div class="col">
                    <input
                            type="submit"
                            class="btn btn-success"
                            value="Сохранить"
                    />
                </div>
            </div>
        </form>
        <article class="text-muted col-md-6 offset-md-3 text-justify mt-5">
            Предполагается возможность загрузки и парсинга из фалов excel или других источников данных,
            возможность редактирования списка праздников и выходных дней, а также модификации набора данных вручную
            при дальнейшей эксплуатации. Напоминаю, что в демке не реализованы многие вещи,
            а лишь показано видение проблемы с точки зрения создателя.
        </article>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                researches: [],
                selectedResearch: null,
                notChosenResearches: [],
                chosenResearches: [],
                newResearch: {
                    title: null,
                    days: null
                }
            }
        },
        computed: {
            testDate: function () {
                let daysSummary = this.chosenResearches.reduce((accumulator, element) => {
                    return accumulator += parseInt(element.days)
                }, 0)
                return daysSummary ? window.moment().businessAdd(daysSummary + 1).format('MM-DD-YYYY'): 'не определена'
            }
        },
        created() {
            window.axios.get(window.config.routes.researches)
                .then(response => {
                    this.researches = response.data
                    this.researches.map((research) => {
                        research.isSelected = false
                    })
                    this.regroupResearches()
                })
            window.axios.get(window.config.routes.holidays)
                .then(response => {
                    window.moment.updateLocale('ru', {
                        holidays: response.data,
                        holidayFormat: 'MM-DD-YYYY'
                    })
                })
        },
        methods: {
            addResearch() {
                this.selectedResearch.isSelected = true
                this.selectedResearch = null
                this.regroupResearches()
            },
            dropResearch(research) {
                research.isSelected = false
                this.regroupResearches()
            },
            regroupResearches() {
                this.chosenResearches = this.researches.filter((research) => {
                    return research.isSelected
                })
                this.notChosenResearches = this.researches.filter((research) => {
                    return !research.isSelected
                })
                this.notChosenResearches.sort(function (first, second) {
                    return first.id > second.id ? 1: -1
                })

            },
            saveResearch() {
                axios.post(window.config.routes.researches, this.newResearch)
                    .then(response => {
                        response.data.isSelected = false
                        this.researches.push(response.data)
                        this.regroupResearches()
                        this.newResearch = {
                            title: null,
                            days: null
                        }
                    })
                    .catch(error => {console.log(error)})
            }
        },
    }
</script>

<style>
    .centered {
        display: flex;
        justify-content: center;
        align-items: center;
        height: available;
    }
    select.form-control {
        max-width: 300px;
    }
    .dropper {
        margin-left: auto;
        cursor: pointer;
        color: darkred;
    }
    .chosen-list {
        max-height: 20vh;
        overflow-y: scroll;
    }
    .chosen-element {
        border: 1px solid lightslategrey;
        border-radius: 5px;
        padding: 3px;
        display: flex;
        margin-right: auto;
        margin-top: 3px;
    }
</style>

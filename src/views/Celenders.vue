<template>
<v-layout>
      <v-flex>
             <v-sheet height="500">
          <v-calendar
            :now="today"
            :value="today"
            color="primary"
          >
            <template v-slot:day="{ date }">
              <template v-for="event in eventsMap[date]">
                <v-menu
                  :key="event.title"
                  v-model="event.open"
                  full-width
                  offset-x
                >
                  <template v-slot:activator="{ on }">
                    <div
                      v-if="!event.time"
                      v-ripple
                      class="my-event"
                      v-on="on"
                      v-html="event.title"
                    ></div>
                  </template>
                  <v-card
                    color="grey lighten-4"
                    min-width="350px"
                    flat
                  >
                    <v-toolbar
                      color="primary"
                      dark
                    >
                      <v-btn icon>
                        <v-icon>edit</v-icon>
                      </v-btn>
                      <v-toolbar-title v-html="event.title"> aaa</v-toolbar-title>
                      <v-spacer></v-spacer>
                      <v-btn icon>
                        <v-icon>favorite</v-icon>
                      </v-btn>
                      <v-btn icon>
                        <v-icon>more_vert</v-icon>
                      </v-btn>
                    </v-toolbar>
                    <v-card-title primary-title>
                      <span v-html="event.details"></span>
                    </v-card-title>
                    <v-card-actions>
                      <v-btn
                        flat
                        color="secondary"
                      >
                        Cancel
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-menu>
              </template>
            </template>
          </v-calendar>
       </v-sheet>
        <v-flex
        sm4
        xs12
        class="text-sm-left text-xs-center"
      >
        <v-btn @click="$refs.calendar.prev()">
          Prev
        </v-btn>
      </v-flex>
      <v-flex
        sm4
        xs12
        class="text-xs-center"
      >
        <v-select
          v-model="type"
          :items="typeOptions"
          label="Type"
        ></v-select>
      </v-flex>
      <v-flex
        sm4
        xs12
        class="text-sm-right text-xs-center"
      >
        <v-btn @click="$refs.calendar.next()">
          Next
        </v-btn>
      </v-flex>
      </v-flex>

    </v-layout>
</template>

<script>

export default {
  data: () => ({
    today: new Date(),
    typeOptions: [
      { text: 'Day', value: 'day' },
      { text: '4 Day', value: '4day' },
      { text: 'Week', value: 'week' },
      { text: 'Month', value: 'month' },
      { text: 'Custom Daily', value: 'custom-daily' },
      { text: 'Custom Weekly', value: 'custom-weekly' },
    ],
    events: [
      {
        title: 'Vacation',
        details: 'Going to the beach!',
        date: '2019-04-30',
        open: false,
      },
      {
        title: 'bbb',
        details: 'Goin2019-01-07g to the beach!',
        date: '2019-04-30',
        open: false,
      },
      {
        title: 'Vacation',
        details: 'Going to the beach!',
        date: '2019-04-30',
        open: false,
      },
      {
        title: 'Meeting',
        details: 'Spending time on how we do not have enough time',
        date: '2019-04-30',
        open: false,
      },
      {
        title: '30th Birthday',
        details: 'Celebrate responsibly',
        date: '2019-04-30',
        open: false,
      },
      {
        title: '30th Birthday',
        details: 'Celebrate responsibly',
        date: '2019-04-30',
        open: false,
      },
      {
        title: '30th Birthday',
        details: 'Celebrate responsibly',
        date: '2019-04-30',
        open: false,
      },
      {
        title: '30th Birthday',
        details: 'Celebrate responsibly',
        date: '2019-04-30',
        open: false,
      },
      {
        title: '30th Birthday',
        details: 'Celebrate responsibly',
        date: '2019-04-30',
        open: false,
      },
      {
        title: '30th Birthday',
        details: 'Celebrate responsibly',
        date: '2019-04-30',
        open: false,
      },
      {
        title: 'New Year',
        details: 'Eat chocolate until you pass out',
        date: '2019-01-01',
        open: false,
      },
      {
        title: 'Conference',
        details: 'Mute myself the whole time and wonder why I am on this call',
        date: '2019-01-21',
        open: false,
      },
      {
        title: 'Hackathon',
        details: 'Code like there is no tommorrow',
        date: '2019-02-01',
        open: false,
      },
    ],
    
  }),
  computed: {
    // convert the list of events into a map of lists keyed by date
    eventsMap() {
      const map = {}
      // eslint-disable-next-line no-return-assign
      this.events.forEach(e => (map[e.date] = map[e.date] || []).push(e))
      return map
    },
  },
  methods: {
    open(event) {
      alert(event.title)
    },
  },
}
</script>

.my-event {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  border-radius: 2px;
  background-color: #1867c0;
  color: #ffffff;
  border: 1px solid #1867c0;
  width: 100%;
  font-size: 12px;
  padding: 3px;
  cursor: pointer;
  margin-bottom: 1px;
}

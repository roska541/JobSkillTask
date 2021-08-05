<template>
    <div>
        <b-container v-if="showWelcome">
            <h4> Please Fill out your information</h4>
            <b-form-group
                id="input-group-email"
                label="Email address:"
                label-for="input-email"
                description="We'll never share your email with anyone else."
            >
                <b-form-input
                    id="input-email"
                    v-model="user.email"
                    type="email"
                    placeholder="Enter email"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="input-group-name"
                label="Your Name:"
                label-for="input-name">
                <b-form-input
                    id="input-name"
                    v-model="user.name"
                    placeholder="Enter name"
                    required
                ></b-form-input>
            </b-form-group>

            <b-container>
                <b-form-group label="Please select your skills" v-slot="{ ariaDescribedby }">
                    <b-form-checkbox-group
                        id="checkbox-group-2"
                        v-model="selected_skills"
                        :aria-describedby="ariaDescribedby"
                        name="flavour-2"
                    >
                        <b-form-checkbox-group
                            id="checkbox-group-1"
                            v-model="selected_skills"
                            :options="options_skills"
                            :aria-describedby="ariaDescribedby"
                            name="skills"
                        ></b-form-checkbox-group>
                    </b-form-checkbox-group>
                </b-form-group>

            </b-container>

            <b-button @click="continueWelcome" variant="primary">Continue</b-button>
            <b-button @click="onReset" variant="danger">Reset</b-button>
        </b-container>
        <b-container v-if="showSkill">
            <h3> Please rate your skills</h3>
            <b-list-group>
                <b-list-group-item v-for="skill in user_skills">
                    <b-row>
                        <b-col cols="7">
                            Skill: <br> <b>{{skill.attributes.skill_name}}</b>
                        </b-col>
                        <b-col cols="5">
                            Rate  <b-form-rating v-model="skill.attributes.rating"></b-form-rating>
                        </b-col>
                    </b-row>
                </b-list-group-item>
            </b-list-group>

            <b-button @click="continueSkills" variant="primary">Continue</b-button>
        </b-container>
        <b-container v-if="showJobList">
            <h3> Best Matches for you {{user.attributes.name}} !</h3>
            <vue-good-table
                :columns="columns"
                :rows="jobs">
                <template slot="table-row" slot-scope="props">
                    <span v-if="props.column.field === 'actions'">
                        <b-button variant="primary"> Apply Now! </b-button>
                    </span>
                </template>
            </vue-good-table>
        </b-container>
    </div>

</template>

<script>
    import { BootstrapVue } from 'bootstrap-vue';
    import VueGoodTablePlugin from 'vue-good-table';

    export default {
        name: "Welcome",
        components: { BootstrapVue, VueGoodTablePlugin },
        props: ["onCompleteWelcome"],
        data(){
            return{
                user: {
                  email:"",
                  name:"",
                },
                skills:[],
                selected_skills:[],
                options_skills:[],
                user_skills:[],
                jobs:[],
                columns:[
                    {
                        label: 'Job Name',
                        field: 'attributes.name',
                    },
                    {
                        label: 'Company',
                        field: 'attributes.company_name',
                    },
                    {
                        label: 'Actions',
                        field: 'actions',
                    },
                ],
                showWelcome:true,
                showSkill:false,
                showJobList:false,
            }
        },
        mounted() {
            this.getSkills();
        },
        methods:{
            continueWelcome:function()
            {
                this.$http.post('/users', {
                    email:this.user.email,
                    name:this.user.name,
                    skills:this.selected_skills
                }).then((response) => {
                    let user = response.data.data;
                    //Filter skills that are matched with user
                    let return_skills  = response.data.included;
                    let user_skills = this.skills.filter(function (s1) {
                        return return_skills.some(function (s2) {
                            return s1.id === s2.attributes.skill_id; // return the ones with equal id
                        });
                    });
                    this.complete_welcome(user, user_skills);

                }).catch((error) => {
                    console.log(error);
                });
            },
            onReset:function () {
                this.user.email = null;
                this.user.name = null;
                this.selected_skills = [];
            },
            continueSkills:function(){
                this.$http.put('/user_skills', {
                    email:this.user.attributes.email,
                    skills:this.user_skills,
                }).then((response) => {
                    this.user_skills = response.data.data;
                    this.getJobs();
                    this.completeSkill();
                }).catch((error) => {
                    console.log(error);
                });
            },
            getSkills:function(){
                this.$http.get('/skills')
                    .then((response) => {
                   this.skills = response.data.data;
                   console.log(this.skills[0]);
                   for(let i=0; i < this.skills.length; i++){
                       this.options_skills.push({
                           text: this.skills[i].attributes.skill_name,
                           value: this.skills[i].id,
                       });
                   }
                   console.log(this.options_skills);
                }).catch((error) => {
                });
            },
            getJobs(){
                this.$http.get('/job_skills?email='+this.user.attributes.email).then((response) => {
                    this.jobs = response.data.data;
                    // for(let i=0; i <= this.jobs.length; i++){
                    //
                    // }
                }).catch((error) => {
                });
            },
            complete_welcome:function(user, user_skills){
                this.showWelcome = false;
                this.showSkill = true;
                this.user = user;
                this.user_skills = user_skills;
            },
            completeSkill:function(){
                this.showSkill = false;
                this.showJobList = true;
            }
        }
    }
</script>

<style scoped>

</style>

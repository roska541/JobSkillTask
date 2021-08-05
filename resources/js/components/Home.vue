<template>
    <div>
        <Welcome v-if="showWelcome"></Welcome>
    </div>
</template>

<script>
    import Welcome from "./Welcome";
    import SkillsRate from "./SkillsRate";
    import JobList from "./JobList";

    export default {
        name: "Home",
        components: {Welcome, SkillsRate, JobList},
        data(){
            return{
                showWelcome:true,
                showSkill:false,
                showJobList:false,
                user:[],
                user_skills:[],
            }
        },
        methods:{

        }
    }
</script>

<style scoped>

</style>

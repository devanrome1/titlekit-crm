<template>
    <div class="fluentcrm-forms fluentcrm-view-wrapper fluentcrm_view">
        <template v-if="has_campaign_pro">
            <ul style="margin-bottom: 20px;" class="fc_settings_sub_menu fc_report_sub_menu">
                <li v-for="(providerItem, providerKey) in providers" :class="{ fc_active: (providerKey == provider) }"
                    @click="provider = providerKey" :key="providerKey">
                    {{ providerItem.title }}
                </li>
            </ul>
            <div v-loading="loading" class="">
                <commerce-reports v-if="provider && !switching" :provider="provider"/>
            </div>
        </template>
        <div v-else>
            <div class="fc_adv_report_demo tk_brand_promo">
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
import CommerceReports from './_CommerceReports';

export default {
    name: 'ReportsHome',
    components: {
        CommerceReports
    },
    data() {
        return {
            reporters: [],
            loading: false,
            provider: 'crm',
            providers: [],
            switching: false
        }
    },
    watch: {
        provider() {
            this.$router.push({
                name: 'reports',
                query: {
                    provider: this.provider
                }
            });
            this.switching = true;
            setTimeout(() => {
                this.switching = false;
            }, 100);
        }
    },
    methods: {
        getReportProviders() {
            this.loading = true;
            this.$get('reports/advanced-providers')
                .then(response => {
                    this.providers = response.providers;
                })
                .catch(error => {
                    this.handleError(error);
                })
                .finally(() => {
                    this.loading = false;
                });
        }
    },
    mounted() {
        this.changeTitle(this.$t('Reports'));
        if (this.has_campaign_pro) {
            this.getReportProviders();
            if (this.$route.query.provider) {
                this.provider = this.$route.query.provider;
            }
        }
    }
}
</script>

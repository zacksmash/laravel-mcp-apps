<script setup lang="ts">
import ApproveAuthorizationController from '@/actions/Laravel/Passport/Http/Controllers/ApproveAuthorizationController';
import DenyAuthorizationController from '@/actions/Laravel/Passport/Http/Controllers/DenyAuthorizationController';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter } from '@/components/ui/card';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle, X } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    request: any;
    authToken: string;
    client: any;
    user: any;
    scopes: Array<{ id: string; description: string }>;
}>();

const processing = ref(false);
</script>

<template>
    <AuthLayout
        :title="`Authorize ${props.client?.name}`"
        description="Authorize the application to access your account"
    >
        <Head title="Authorize Application" />

        <Card>
            <CardContent class="flex flex-col gap-6">
                <div class="rounded-lg border bg-muted/50 p-4">
                    <p class="mb-2 text-sm text-muted-foreground">
                        Logged in as:
                    </p>
                    <p class="font-medium">{{ props.user?.email }}</p>
                </div>

                <div class="space-y-2" v-if="props.scopes?.length > 0">
                    <p class="text-sm font-medium">Permissions:</p>

                    <ul class="space-y-2">
                        <li
                            class="flex items-start gap-2"
                            v-for="scope in props.scopes"
                            :key="scope.id"
                        >
                            <div class="mt-0.5 rounded-full bg-primary/10 p-1">
                                <div
                                    class="h-1.5 w-1.5 rounded-full bg-primary"
                                ></div>
                            </div>
                            <span class="text-sm text-muted-foreground">
                                {{ scope.description }}
                            </span>
                        </li>
                    </ul>
                </div>
            </CardContent>

            <CardFooter class="flex items-center gap-2">
                <Form
                    v-slot="{ processing }"
                    v-bind="DenyAuthorizationController.deny.form()"
                    class="flex-1"
                >
                    <input type="hidden" name="state" value="" />
                    <input
                        type="hidden"
                        name="client_id"
                        :value="props.client?.id"
                    />
                    <input
                        type="hidden"
                        name="auth_token"
                        :value="props.authToken"
                    />
                    <Button
                        :disabled="processing"
                        variant="outline"
                        class="w-full"
                    >
                        <X class="mr-2 size-4" />
                        Cancel
                    </Button>
                </Form>

                <form
                    method="POST"
                    :action="ApproveAuthorizationController.approve.url()"
                    class="flex-1"
                >
                    <input type="hidden" name="state" value="" />
                    <input
                        type="hidden"
                        name="client_id"
                        :value="props.client?.id"
                    />
                    <input
                        type="hidden"
                        name="auth_token"
                        :value="props.authToken"
                    />
                    <Button
                        :disabled="processing"
                        class="w-full"
                        @click="processing = true"
                    >
                        Authorize
                        <LoaderCircle
                            v-if="processing"
                            class="mr-3 -ml-1 size-4 animate-spin text-white"
                        />
                    </Button>
                </form>
            </CardFooter>
        </Card>
    </AuthLayout>
</template>

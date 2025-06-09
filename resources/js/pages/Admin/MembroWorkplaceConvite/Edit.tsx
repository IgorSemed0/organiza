import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Create({ workplaces, users }) {
    const { data, setData, post, processing, errors } = useForm({
        it_id_workplace: '',
        it_id_user_convidado: '',
        it_id_user_convidador: '',
        vc_status: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('admin.membro_workplace_convites.store'));
    };

    return (
        <AdminLayout title="Criar Convite para Espaço de Trabalho">
            <Head title="Criar Convite para Espaço de Trabalho" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Criar Convite para Espaço de Trabalho</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.membro_workplace_convites.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_workplace">Espaço de Trabalho</Label>
                            <Select
                                value={data.it_id_workplace}
                                onValueChange={(value) => setData('it_id_workplace', value)}
                            >
                                <SelectTrigger id="it_id_workplace" className={errors.it_id_workplace ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um espaço de trabalho" />
                                </SelectTrigger>
                                <SelectContent>
                                    {workplaces.map((workplace) => (
                                        <SelectItem key={workplace.id} value={workplace.id.toString()}>
                                            {workplace.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_workplace && <p className="text-sm text-red-500">{errors.it_id_workplace}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_convidado">Convidado</Label>
                            <Select
                                value={data.it_id_user_convidado}
                                onValueChange={(value) => setData('it_id_user_convidado', value)}
                            >
                                <SelectTrigger id="it_id_user_convidado" className={errors.it_id_user_convidado ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador convidado" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user_convidado && <p className="text-sm text-red-500">{errors.it_id_user_convidado}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_convidador">Convidador</Label>
                            <Select
                                value={data.it_id_user_convidador}
                                onValueChange={(value) => setData('it_id_user_convidador', value)}
                            >
                                <SelectTrigger id="it_id_user_convidador" className={errors.it_id_user_convidador ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador convidador" />
                                </SelectTrigger>
                                <SelectContent>
                                    {users.map((user) => (
                                        <SelectItem key={user.id} value={user.id.toString()}>
                                            {user.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_user_convidador && <p className="text-sm text-red-500">{errors.it_id_user_convidador}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_status">Status</Label>
                            <Input
                                id="vc_status"
                                type="text"
                                value={data.vc_status}
                                onChange={(e) => setData('vc_status', e.target.value)}
                                className={errors.vc_status ? 'border-red-500' : ''}
                            />
                            {errors.vc_status && <p className="text-sm text-red-500">{errors.vc_status}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Criar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}
import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Edit({ item, quadros, users }) {
    const { data, setData, put, processing, errors } = useForm({
        it_id_quadro: item.it_id_quadro?.toString() || '',
        it_id_user_convidado: item.it_id_user_convidado?.toString() || '',
        it_id_user_convidador: item.it_id_user_convidador?.toString() || '',
        vc_status: item.vc_status || '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.membro_quadro_convites.update', item.id));
    };

    return (
        <AdminLayout title="Editar Convite para Quadro">
            <Head title="Editar Convite para Quadro" />
            <Card>
                <CardHeader>
                    <div className="flex items-center justify-between">
                        <CardTitle>Editar Convite para Quadro</CardTitle>
                        <div className="flex space-x-2">
                            <Link href={route('admin.membro_quadro_convites.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </div>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="it_id_quadro">Quadro</Label>
                            <Select
                                value={data.it_id_quadro}
                                onValueChange={(value) => setData('it_id_quadro', value)}
                            >
                                <SelectTrigger id="it_id_quadro" className={errors.it_id_quadro ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um quadro" />
                                </SelectTrigger>
                                <SelectContent>
                                    {quadros.map((quadro) => (
                                        <SelectItem key={quadro.id} value={quadro.id.toString()}>
                                            {quadro.vc_nome}
                                        </SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {errors.it_id_quadro && <p className="text-sm text-red-500">{errors.it_id_quadro}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_convidado">Convidado</Label>
                            <Select
                                value={data.it_id_user_convidado}
                                onValueChange={(value) => setData('it_id_user_convidado', value)}
                            >
                                <SelectTrigger id="it_id_user_convidado" className={errors.it_id_user_convidado ? 'border-red-500' : ''}>
                                    <SelectValue placeholder="Selecione um utilizador" />
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
                                    <SelectValue placeholder="Selecione um utilizador" />
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
                            <Button type="submit" disabled={processing}>Atualizar</Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}
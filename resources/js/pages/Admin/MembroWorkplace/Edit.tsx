import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

export default function Edit({ item, workplaces, users }) {
    const { data, setData, put, processing, errors } = useForm({
        it_id_workplace: item.it_id_workplace?.toString() || '',
        it_id_user: item.it_id_user?.toString() || '',
        vc_funcao: item.vc_funcao || '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.membro_workplaces.update', item.id));
    };

    return (
        <AdminLayout title="Editar Membro de Espaço de Trabalho">
            <Head title="Editar Membro de Espaço de Trabalho" />
            <Card>
                <CardHeader>
                    <CardTitle>Editar Membro de Espaço de Trabalho</CardTitle>
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
                            <Label htmlFor="it_id_user">Utilizador</Label>
                            <Select
                                value={data.it_id_user}
                                onValueChange={(value) => setData('it_id_user', value)}
                            >
                                <SelectTrigger id="it_id_user" className={errors.it_id_user ? 'border-red-500' : ''}>
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
                            {errors.it_id_user && <p className="text-sm text-red-500">{errors.it_id_user}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_funcao">Função</Label>
                            <Input
                                id="vc_funcao"
                                type="text"
                                value={data.vc_funcao}
                                onChange={(e) => setData('vc_funcao', e.target.value)}
                                className={errors.vc_funcao ? 'border-red-500' : ''}
                            />
                            {errors.vc_funcao && <p className="text-sm text-red-500">{errors.vc_funcao}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Atualizar</Button>
                            <Link href={route('admin.membro_workplaces.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}
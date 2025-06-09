import { Head, useForm, Link } from '@inertiajs/react';
import AdminLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';

export default function Edit({ item, users }) {
    const { data, setData, put, processing, errors } = useForm({
        vc_nome: item.vc_nome || '',
        vc_descricao: item.vc_descricao || '',
        it_id_user_criador: item.it_id_user_criador?.toString() || '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.workplaces.update', item.id));
    };

    return (
        <AdminLayout title="Editar Espaço de Trabalho">
            <Head title="Editar Espaço de Trabalho" />
            <Card>
                <CardHeader>
                    <CardTitle>Editar Espaço de Trabalho</CardTitle>
                </CardHeader>
                <CardContent>
                    <form onSubmit={handleSubmit} className="space-y-4">
                        <div>
                            <Label htmlFor="vc_nome">Nome</Label>
                            <Input
                                id="vc_nome"
                                type="text"
                                value={data.vc_nome}
                                onChange={(e) => setData('vc_nome', e.target.value)}
                                className={errors.vc_nome ? 'border-red-500' : ''}
                            />
                            {errors.vc_nome && <p className="text-sm text-red-500">{errors.vc_nome}</p>}
                        </div>
                        <div>
                            <Label htmlFor="vc_descricao">Descrição</Label>
                            <Textarea
                                id="vc_descricao"
                                value={data.vc_descricao}
                                onChange={(e) => setData('vc_descricao', e.target.value)}
                                className={errors.vc_descricao ? 'border-red-500' : ''}
                            />
                            {errors.vc_descricao && <p className="text-sm text-red-500">{errors.vc_descricao}</p>}
                        </div>
                        <div>
                            <Label htmlFor="it_id_user_criador">Criador</Label>
                            <Select
                                value={data.it_id_user_criador}
                                onValueChange={(value) => setData('it_id_user_criador', value)}
                            >
                                <SelectTrigger id="it_id_user_criador" className={errors.it_id_user_criador ? 'border-red-500' : ''}>
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
                            {errors.it_id_user_criador && <p className="text-sm text-red-500">{errors.it_id_user_criador}</p>}
                        </div>
                        <div className="flex space-x-2">
                            <Button type="submit" disabled={processing}>Atualizar</Button>
                            <Link href={route('admin.workplaces.index')}>
                                <Button variant="outline">Voltar</Button>
                            </Link>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </AdminLayout>
    );
}